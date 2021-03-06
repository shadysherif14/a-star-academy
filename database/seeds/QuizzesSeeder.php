<?php

use App\Answer;
use App\Question;
use App\Video;
use Illuminate\Database\Seeder;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $videos = Video::select('id')->get();

        $videos->each(function ($video) {

            for ($order = 1; $order <= 20; $order++) {

                $question = factory(Question::class)->create([
                    'video_id' => $video->id,
                    'order' => $order,
                ]);

                $correctAnswer = factory(Answer::class)->create([
                    'question_id' => $question->id,
                ]);

                $question->answer_id = $correctAnswer->id;

                $question->save();

                factory(Answer::class, 3)->create([
                    'question_id' => $question->id,
                ]);

            }

        });
    }
}
