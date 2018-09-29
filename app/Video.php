<?php

namespace App;

use App\Traits\Routes;
use App\Traits\Payable;
use App\Interfaces\PayableInterface;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Video extends Model implements PayableInterface
{

    const ROUTE = 'videos';

    protected $appends = ['admin_routes'];
    
    use Sluggable, Payable, Routes;

    public $guarded = [];

    public function duration()
    {
        $duration = json_decode($this->duration);
        $h = $duration->hour ? $duration->hour . 'h ' : '';
        $m = $duration->min ? $duration->min . 'm ' : '';
        $s = $duration->sec ? $duration->sec . 's' : '';

        $str = join('', [$h, $m, $s]);
        return $str;
    }

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
        return $this->hasMany(Question::class);
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

    public function getPathAttribute($value)
    {
        return asset("storage/{$value}");
    }

    public static function videos($courseID)
    {
        return self::where('course_id', $courseID)

            ->oldest('order')

            ->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function persistUser($user)
    {
        $this->users()->save($user);
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
}
