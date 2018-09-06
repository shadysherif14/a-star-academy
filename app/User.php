<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function name($user = null)
    {
        $user = is_null($user) ? auth()->user() : $user;

        return explode(' ', $user->name);
    }
    public static function firstName($user = null)
    {

        $nameArray = (new self)->name($user);

        return (sizeof($nameArray) > 0) ? $nameArray[0] : 'N.A';
    }

    public static function lastName($user = null)
    {
        $nameArray = (new self)->name($user);

        return (sizeof($nameArray) > 1) ? $nameArray[1] : 'N.A';
    }

    public function canWatch($video)
    {
        $result = DB::table('users_videos')->where([
            'user_id' => $this->id,
            'video_id' => $video->id,
        ])->get();

        //dd($result);
        if (count($result)) {
            return true;
        }
        return false;
    }
}
