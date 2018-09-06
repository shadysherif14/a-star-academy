<?php

namespace App\Http\Requests;

use App\Level;
use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
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
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->nameSchoolCombination($fail);
                },
            ],
            'school' => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->nameSchoolCombination($fail);
                },
            ],
            'image' => 'image',
        ];
    }

    public function nameSchoolCombination($fail)
    {
        $exist = Level::where([
            ['name', $this->name],
            ['school', $this->school],
        ])->exists();

        if ($exist) {
            return $fail('There is a level has the combination of name and school.');
        }

    }
}
