<?php

namespace App\Http\Requests;

use App\Level;
use App\Rules\LevelNameAndSchool;
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

        $level = $this->route('level');

        $levelID = $level ? $level->id : null;

        return [
            'name' => [
                'required',
                new LevelNameAndSchool($this->name, $this->school, $levelID)
            ],
            'school' => [
                'required',
                new LevelNameAndSchool($this->name, $this->school, $levelID)
            ],
            'image' => 'image',
        ];
    }
}
