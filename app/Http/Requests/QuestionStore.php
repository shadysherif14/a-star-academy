<?php

namespace App\Http\Requests;

use App\Rules\AnswersCount;
use App\Rules\CorrectAnswer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class QuestionStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'new_question' => [
                'required',
                Rule::unique('questions', 'body')->where(function ($query) {
                    return $query->where('video_id', $this->video_id);
                }),
            ],

            'new_correct_answer' => [
                'required',
                new CorrectAnswer,
            ],

            'answers' => [
                'required',
                new AnswersCount,
            ],

            'answers.*.body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.required' => 'All answers cannot be empty',
            'question.unique' => 'This question has already exists in this video\'s questions.',
        ];
    }
}
