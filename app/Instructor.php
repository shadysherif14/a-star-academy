<?php

namespace App;

use App\Traits\Routes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{

    const ROUTE = 'instructors';

    const DEFAULT_IMAGE_PATH = 'images/defaults/avatar.png';

    use Sluggable, Routes, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'accounts' => 'object',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function getAvatarAttribute($path)
    {
        $path = $path ? : self::DEFAULT_IMAGE_PATH;

        return secure_asset("storage/{$path}");
    }

    /**
     * Get all of the courses for the instructor.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Get all of the videos for the instructor.
     */
    public function videos()
    {
        return $this->hasManyThrough(Video::class, Course::class);
    }

    public function getCoursesCountAttribute()
    {
        $courses = $this->courses->count();

        return $courses . ' ' . str_plural('Course', $courses);
    }

    public function getVideosCountAttribute()
    {
        $videos = $this->videos->count();

        return $videos . ' ' . str_plural('Sessions', $videos);
    }

    public function getAccountsAttribute($accounts)
    {
        return json_decode($accounts);
    }

    public function accounts($account = null)
    {

        if (is_null($this->id)) {
            return null;
        }

        return isset($this->accounts->$account) ? $this->accounts->$account : null;
    }

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
                'separator' => '',
            ],
        ];
    }
    

}
