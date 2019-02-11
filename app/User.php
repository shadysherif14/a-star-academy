<?php

namespace App;

use App\Session as LoginSession;
use App\Traits\Routes;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Love\Liker\Models\Liker as LikerContract;

class User extends Authenticatable implements LikerContract
{
    const ROUTE = 'users';

    const ROUTES = ['index', 'destroy'];

    const DEFAULT_IMAGE_PATH = 'images/defaults/avatar.png';

    use Notifiable, Routes, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /** Relations */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)->withPivot(['price', 'created_at']);
    }

    public function questions()
    {
        return $this->hasManyTrough(Question::class, Quiz::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function activeVideos()
    {
        return $this->belongsToMany(Video::class)

            ->whereRaw('max_watching_times > watched_times')

            ->orWhere('max_watching_times', null);
    }
    /** Relations */

    public function getRouteKeyName()
    {
        return 'username';
    }

    /** Accessors */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatarAttribute($path)
    {
        $path = $path ?? self::DEFAULT_IMAGE_PATH;

        return secure_asset("storage/{$path}");
    }

    public function getCroppedAvatarAttribute($path)
    {
        $path = $path ?? self::DEFAULT_IMAGE_PATH;

        return secure_asset("storage/{$path}");
    }

    public function getAccountsAttribute($accounts)
    {
        return json_decode($accounts);
    }
    /** Accessors */

    public function accounts($account = null)
    {
        if (is_null($this->id)) {
            return null;
        }

        return isset($this->accounts->$account) ? $this->accounts->$account : null;
    }
    public function canWatch(Video $video)
    {
        return $video->userCanWatch($this);
    }

    public function profileRoutes($action = 'show')
    {
        return route("profiles.{$action}");
    }

    public function courses()
    {
        return Course::whereLikedBy($this->id)
            ->with('likesCounter') // Allow eager load (optional)
            ->get();
    }

    public function totalSubscriptions()
    {
        return UserVideo::whereUserId($this->id)->sum('price');
    }

    public function invalidateAllLogginSessions()
    {
        LoginSession::deleteByUserID($this->id);
    }
}