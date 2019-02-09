<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\VideoPathRule;


class VideoRequest extends FormRequest
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
            // 'name' => 'required',
            'title' => 'required',
            'max_price' => 'required_unless:overview,1|numeric',
            'max_times' => 'required_unless:overview,1|numeric',
            'one_price' => 'required_unless:overview,1|numeric',
            'overview' => ['nullable', Rule::in(['1'])],
            // 'duration' => 'required',
            'video' => [
                'bail',
                'required',
                new VideoPathRule,
            ],
        ];
    }

    protected function withValidator($validator)
    {

        if ($validator->fails()) {

            $validator->after(function($validator) {
                
                $validator->errors()->add('target', $this->target);
            });
        }
    }

}
