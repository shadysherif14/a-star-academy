<?php

namespace App\Http\Requests;

use App\Rules\AuthPassword;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdate extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255',
                Rule::unique('users', 'username')->ignore(auth()->id()),
            ],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
            'old_password' => ['nullable', new AuthPassword],
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image',
            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
            'accounts.*' => 'nullable|url',
            'phone' => 'nullable|numeric',
        ];
    }
}
