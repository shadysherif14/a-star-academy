<?php

namespace App\Http\Requests;

use App\Level;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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

        $schools = Level::select('school')->get()->unique('school')->pluck('school');

        $systems = array('Cambridge', 'Edexcel');

        $subSystems = array('AL', 'OL', 'A2', 'AS');
        
        return [

            'name' => 'required',

            // 'description' => 'required',
            
            'school' => ['required', Rule::in($schools)],
            
            'system' => ['nullable', Rule::in($systems)],
            
            'sub_system' => ['nullable', Rule::in($subSystems)],

            'image' => 'image',

            'level' => 'required|exists:levels,id',

            'instructor' => 'required|exists:instructors,id'            
        ];
    }
}
