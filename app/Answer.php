<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getCorrectAttribute()
    {
        return $this->body === $this->question->correct_answer;
    }

    public function answerStyle()
    {
        return $this->correct ? 'text-success' : 'text-muted';
    }
}
