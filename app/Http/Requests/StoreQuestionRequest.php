<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'question' => 'required',
            'correct_answer' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, request()->answers)) {
                        return $fail('The correct answer should be the same as one of the answers.');
                    }
                },
            ],

            'answers' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (count(request()->answers) < 2) {
                        return $fail('The answers should be at least two.');
                    }
                },
            ],

            'answers.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.required' => 'All answers cannot be empty',
        ];
    }
}
