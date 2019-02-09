<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InstructorUpdateRequest extends FormRequest
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

        $instructor = auth()->guard('instructor')->user() ?? $this->route('instructor');

        return [

            'name' => 'required',

            'about' => 'required',

            'email' => ['required', 'email', Rule::unique('instructors', 'email')->ignore($instructor->id)],

            'phone' => 'nullable|numeric',

            'password' => 'nullable|confirmed',

            'avatar' => 'image',
        ];

    }
}
