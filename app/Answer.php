<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getIsCorrectAttribute()
    {
        return $this->id === $this->question->answer_id;
    }

    public function answerStyle()
    {
        return $this->is_correct ? 'text-success' : 'text-muted';
    }

    public static function findAnswer($questionID, $body)
    {
        return self::where([
            'question_id' => $questionID,
            'body' => $body,
        ])->first();
    }

    public static function syncAnswers($questionID, $answersID)
    {
        Answer::where('question_id', $questionID)->whereNotIn('id', $answersID)->delete();
    }
}
