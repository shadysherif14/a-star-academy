<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function store(Video $video)
    {
        $correct = 0;

        $userQuestions = [];

        $quiz = Auth::user()->quizzes()->create([
            'video_id' => $video->id
        ]);

        $query = $video->questions();

        $questions = $query->count();

        $query->select('id', 'answer_id')

            ->get()

            ->each(function ($question) use (&$correct, &$userQuestions) {

                $answerID = intval(request("question-{$question->id}"));

                $correctAnswer = $question->answer_id === $answerID;

                if ($correctAnswer) {
                    $correct++;
                }

                $userQuestions[] = [
                    'question_id' => $question->id,
                    'correct' => $correctAnswer,
                ];
            });

        $quiz->questions()->createMany($userQuestions);

        return response()->json(compact('correct', 'questions'));
    }
}
