<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{



    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * Get the user that owns that comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
