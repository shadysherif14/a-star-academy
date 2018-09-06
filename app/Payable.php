<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    
    public function payable()
    {
        return $this->morphTo();
    }

    public function orders()
    {
        return $this->hasMany(PayMobOrder::class);
    }
}
