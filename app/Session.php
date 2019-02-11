<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "sessions";

    
    // Check If a Given User Is Currently Logged In Or Not
    public static function otherDevicesLoggedIn($userID)
    {
        if (is_null($userID) || !$userID) {
            return null;
        }
        return count(Session::where('user_id', $userID)->get()) ? 1 : 0 ;
    }

    // Delete All User's Sessions
    public static function deleteByUserID($userID)
    {
        Session::where('user_id', $userID)->delete();
    }
}