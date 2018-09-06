<?php

namespace App;

use BaklySystems\PayMob\Facades\PayMob;

use Illuminate\Database\Eloquent\Model;

class PayMobOrder extends Model
{


    public function payable()
    {
        return $this->belongsTo(Payable::class);        
    }

}
