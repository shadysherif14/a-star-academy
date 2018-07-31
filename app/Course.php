<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{

    use Sluggable;

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

    public function questions()
    {
        return $this->hasMany(Question::class);
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
