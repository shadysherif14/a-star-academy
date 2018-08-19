<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserBasicInformationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
            'school' => [
                'required',
                Rule::in(['American Diploma', 'IGCSE']),
            ],
            'level' => [
                'required_if:school,IGSCE',
                Rule::in(['8th Grade', '9th Grade', 'IG']),
            ],
            'avatar' => 'image',
        ];
    }
}
