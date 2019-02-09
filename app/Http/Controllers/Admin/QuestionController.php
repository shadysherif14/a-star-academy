<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStore;
use App\Http\Requests\QuestionUpdate;

class QuestionController extends Controller
{

    // Done
    public function index(Video $video)
    {

        $questions = $video->questions;

        $title = $video->title . ' Questions';

        $breadcrumbs = 'admin.quiz';

        $breadcrumbArgument = $video;

        $data = compact('questions', 'video', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.quizzes.index', $data);
    }

    // Done
    public function store(QuestionStore $request, Video $video)
    {

        $question = new Question;

        $question->body = $request->new_question;

        $question->video_id = $video->id;

        $question->order = $order = Question::order($video->id);

        $question->save();

        foreach ($request->answers as $answerData) {

            $answerData = (object) $answerData;

            $answerBody = $answerData->body;

            $answer = new Answer();

            $answer->body = $answerBody;

            $answer->question_id = $question->id;

            $answer->save();

            if ($request->new_correct_answer === $answerBody) {

                $question->updateCorrectAnswer($answer);
            }
        }

        $question->load('answers');

        return response()->json(compact('question'));

    }

    // Done
    public function show(Question $question)
    {
        return response()->json(compact('question'));
    }

    public function update(QuestionUpdate $request, Question $question)
    {

        $question->body = $request->question;

        foreach ($request->answers as $answer) {

            $answerData = (object) $answer;

            $answer = Answer::find($answerData->id);

            if (is_null($answer)) {

                $answer = new Answer;

                $answer->question_id = $question->id;
            }

            $answer->body = $answerData->body;

            $answer->save();

            $answersID[] = $answer->id;

        }

        $question->updateCorrectAnswer($request->correct_answer);

        Answer::syncAnswers($question->id, $answersID);

        return response()->json(compact('question'));
    }

    public function destroy(Question $question)
    {

        $question->delete();

        return jsonResponse(true);
    }

    // Done
    public function order(Request $request)
    {

        $order = 1;

        foreach ($request->questions as $questionID) {

            Question::where('id', $questionID)->update([
                'order' => $order,
            ]);

            $order++;
        }

        return jsonResponse(true);
    }
}
