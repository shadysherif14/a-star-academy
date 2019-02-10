<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    
    public $timestamps = false;

    protected $guarded = ['id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
