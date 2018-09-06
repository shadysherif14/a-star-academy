<?php

namespace App\Traits;

use App\Payable as PayableModel;

trait Payable
{

    public function pay()
    {
        return $this->morphMany(PayableModel::class, 'payable');
    }

}
