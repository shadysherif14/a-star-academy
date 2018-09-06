<?php

namespace App\Interfaces;

interface PayableInterface
{
    public function pay();

    public function persistUser($user);
}