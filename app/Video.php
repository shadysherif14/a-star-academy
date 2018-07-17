<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get all of the course's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
