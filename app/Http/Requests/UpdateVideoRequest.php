<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            'title' => 'required',
            'unlimited_price' => 'required_unless:overview,1|numeric',
            'one_price' => 'required_unless:overview,1|numeric',
            'overview' => ['nullable', Rule::in(['1'])],
            'video' => 'mimes:mp4,mov,ogg,qt,flv,mkv,avi,flv,mpg,mpeg'                    
        ];
    }
}
