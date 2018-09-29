<?php

namespace App;

use App\Video;
use App\Traits\Routes;
use App\Traits\Payable;
use App\Interfaces\PayableInterface;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model implements PayableInterface
{

    const ROUTE = 'courses';
    
    use Sluggable, Payable, Routes;

    public static function boot()
    {

        parent::boot();

        static::deleting(function ($course) {
            $course->videos->each->delete();
        });

    }

    public function updatePrice()
    {
        $videos = $this->videos;

        if (empty($videos)) {
            return;
        }

        $price = $videos->sum('price');

        $this->price = $price;

        $this->save();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function videosRoute($action = 'index')
    {
        return adminRoute(Video::ROUTE . '.' . $action, $this);
    }

    public function getVideosCountAttribute()
    {
        return $this->videos->count() . ' ' . str_plural('session', $this->videos->count());
    }

    public function intro()
    {
        $introduction = Video::where([
            'course_id' => $this->id,
            'free' => 1,
        ])->first();

        return $introduction ? $introduction : false;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function adminPath()
    {
        return "/admin{$this->path()}";
    }

    public function path()
    {
        return "/courses/{$this->slug}";
    }

    public function getImageAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return asset("storage/{$value}");
    }

    /* public function getSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
    }

    public function getSubSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
    } */

    public function persistUser($user)
    {
        $videos = $this->videos;

        $user->videos()->saveMany($videos);
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
                'source' => 'name',
            ],
        ];
    }

}
