<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    
    protected $table = 'notifications';

    public function getUserAttribute()
    {
        return User::find($this->data['user_id']);
    }

    public function getVideoAttribute()
    {
        return Video::find($this->data['video_id']);
    }
}
