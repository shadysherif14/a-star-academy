<?php

namespace App;

use App\Notifications\VideoPaid;
use App\Traits\Routes;
use Carbon\Carbon;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\VideoSubscription;

class Video extends Model implements LikeableContract
{

    const ROUTE = 'videos';

    protected $appends = ['admin_routes', 'poster_update_route'];

    use Sluggable, Routes, Likeable;

    public $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($video) {
            $video->questions->each->delete();
        });

    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->oldest('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function order($courseID)
    {
        $video = self::select('order')

            ->where('course_id', $courseID)

            ->latest('order')

            ->first();

        return is_null($video) ? 1 : $video->order + 1;
    }

    public function users()
    {
        return $this->belongsToMany(User::class)

            ->withPivot('watched_times', 'max_watching_times');

    }

    public function getInstructorAttribute()
    {
        return $this->course->instructor;
    }

    /**
     * Get all of the course's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function questionsRoute($action = 'index')
    {
        return adminRoute(Question::ROUTE . '.' . $action, $this);
    }

    public function getPosterAttribute($poster)
    {
        return secure_asset("storage/$poster");
    }

    public function getPathAttribute($path)
    {
        return secure_asset("storage/$path");
    }

    public function getPosterPathAttribute()
    {
        return "sessions/{$this->slug}/posters";
    }

    public function getPosterUpdateRouteAttribute()
    {
        return action('Admin\PosterController@update', $this);
    }

    public function userCanWatch($user = null)
    {

        if ($this->isOverview()) {
            return true;
        }

        $user = $user ?? Auth::user();

        if (is_null($user)) {
            return false;
        }

        return UserVideo::where([

            'user_id' => $user->id,

            'video_id' => $this->id,

        ])->where(function ($query) {

            $query->whereRaw('max_watching_times > watched_times')

                ->orWhere('max_watching_times', null);

        })->exists();
    }

    public function getIsAllowedAttribute()
    {
        return $this->userCanWatch();
    }

    public function userCanWatchIcon($user = null)
    {
        $user = $user ?? Auth::user();

        return $this->userCanWatch($user) ? 'typcn typcn-lock-open-outline' : 'typcn typcn-lock-closed-outline';
    }

    public function nextVideo()
    {
        $course = $this->course;

        return $this->isLastVideo() ? $course->firstVideo() : $course->findVideoByOrder($this->order + 1);
    }

    public function prevVideo()
    {
        $course = $this->course;

        return $this->isFirstVideo() ? $course->lastVideo() : $course->findVideoByOrder($this->order - 1);
    }

    public function isLastVideo()
    {
        return $this->id === $this->course->lastVideo()->id;
    }

    public function isFirstVideo()
    {
        return $this->id === $this->course->firstVideo()->id;
    }

    public function isOverview()
    {
        $overview = $this->course->overview();

        return !is_null($overview) && $this->id === $overview->id;
    }

    /** Accessors */

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
    /** Accessors */

    public function fireNotification(User $user, $price)
    {
        //dd($user, $this, $price, $this->instructor->name, config('mail.subscription'));
        Notification::send($this->instructor, new VideoPaid($user, $this));
        Notification::send(Admin::all(), new VideoPaid($user, $this));
        Mail::to($this->instructor->email)->send(new VideoSubscription($user, $this, $price, $this->instructor->name, config('mail.subscription')));
        Mail::to(config('mail.subscription'))->send(new VideoSubscription($user, $this, $price, config('app.name'), config('mail.from.address')));
    }

    public function description($limit = 700)
    {
        return is_null($limit) ? $this->description : str_limit($this->description, $limit);
    }

}
