<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use App\Video;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    // Done
    public function index(Video $video)
    {

        $questions = Question::quiz($video->id);

        $title = $video->title . ' Questions';

        $data = compact('questions', 'video', 'title');

        return view('admin.quizzes.index', $data);
    }
    // Done
    public function store(StoreQuestionRequest $request, Video $video)
    {

        $request->validated();

        $order = Question::order($video->id);

        $question = new Question;

        $question->body = $request->question;

        $question->correct_answer = $request->correct_answer;

        $question->video_id = $video->id;

        $question->order = $order;

        $question->save();

        foreach ($request->answers as $answerReq) {

            $answer = new Answer();

            $answer->body = $answerReq;

            $answer->question_id = $question->id;

            $answer->save();
        }

        $status = true;

        $method = 'create';

        return response()->json(compact('status', 'question', 'method'));

    }

    // Done
    public function show($id)
    {

        $question = Question::find($id);

        return response()->json(compact('question'));
    }

    public function update(Request $request, $id)
    {

        $question = Question::find($id);

        $question->body = $request->question;

        $question->correct_answer = $request->correct_answer;

        $question->save();

        foreach ($request->answers as $key => $answer) {

            if (isset($answer['id'])) {

                $answer = (object) $answer;

                Answer::where('id', $answer->id)

                    ->update(['body' => $answer->body]);
            } else {

                $newAnswer = new Answer;

                $newAnswer->body = $answer;

                $newAnswer->question_id = $id;

                $newAnswer->save();
            }
        }

        $answers = collect($request->answers);

        $IDs = $answers->pluck('id');

        Answer::where('question_id', $id)->whereNotIn('id', $IDs)->delete();

        $status = true;

        $method = 'edit';

        return response()->json(compact('status', 'question', 'method'));
    }

    public function destroy($id)
    {

        Question::destroy($id);

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
