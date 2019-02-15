<?php

namespace App;

use App\Traits\Routes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    const ROUTE = 'admins';

    const DEFAULT_IMAGE_PATH = 'images/defaults/avatar.png';

    use Notifiable, Routes;

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

    public function getAvatarAttribute($path)
    {
        $path = $path ?? self::DEFAULT_IMAGE_PATH;

        return secure_asset("storage/{$path}");
    }
    

}
