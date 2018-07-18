<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    public $with = ['courses'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
