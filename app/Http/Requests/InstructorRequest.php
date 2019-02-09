<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstructorRequest extends FormRequest
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

    public function rules()
    {
     
        return [

            'name' => 'required',

            'about' => 'required',

            'email' => ['required', 'email', Rule::unique('instructors', 'email')],

            'phone' => 'nullable|numeric',

            'password' => 'required|confirmed',

            'avatar' => 'image',
        ];
    }
}
