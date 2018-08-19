<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

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

    public function courses() 
    {
        return $this->belongsToMany(Course::class);
    }

    public function canWatch($video){
        $result = DB::table('users_videos')->where([
            'user_id' => $this->id,
            'video_id' => $video->id
        ])->get();

        //dd($result);
        if (count($result)){
            return true;
        }
        return false;
    }
}
