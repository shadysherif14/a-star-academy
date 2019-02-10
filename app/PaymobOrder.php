<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymobOrder extends Model
{
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
