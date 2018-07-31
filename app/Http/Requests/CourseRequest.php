<?php

namespace App\Http\Requests;

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
        $schools = array('American Diploma', 'IGCSE');

        $systems = array('Cambridge', 'Edexcel');

        $subSystems = array('Al', 'Ol', 'A2', 'AS');
        
        return [

            'name' => 'required',

            'description' => 'required',
            
            'school' => ['required', Rule::in($schools)],
            
            'system' => ['required_if:school,IGCSE', Rule::in($systems)],
            
            'sub_system' => ['required_if:school,IGCSE', Rule::in($subSystems)],

            'image' => 'image'
        ];
    }
}
