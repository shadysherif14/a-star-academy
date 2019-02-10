<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function correctQuestions()
    {
        return $this->hasMany(QuizQuestion::class)->whereCorrect(true);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }

}
