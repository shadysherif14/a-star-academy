<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $with = ['answers'];

    public static function boot()
    {

        parent::boot();

        static::deleting(function($question) {

            $question->answers->each->delete();
        });
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function quiz($videoID)
    {
        return self::where('video_id', $videoID)

            ->oldest('order')

            ->get();
    }

    public static function order($videoID)
    {
        $question = self::select('order')

            ->where('video_id', $videoID)

            ->latest('order')

            ->first();

        return is_null($question) ? 1 : $question->order + 1;
    }

}
