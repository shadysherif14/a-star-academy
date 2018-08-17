<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{

    use Sluggable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public static function boot()
    {

        parent::boot();

        static::deleting(function($course) {
            $course->videos->each->delete();
        });

    }

    public function getRouteKeyName()
    {
        return 'slug';
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
        if(is_null($value)) return null;
        
        return asset("storage/{$value}");
    }

    public function getSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
    }

    public function getSubSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
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
                'source' => 'name'
            ]
        ];
    }

}
