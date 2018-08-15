<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'videos' => 'required',
            'videos.*.original_name' => 'required',
            'files' => 'required',
            'files.*' => 'required|mimes:mp4,mov,ogg,qt,flv,mkv,avi,flv,mpg,mpeg'        
        ];
    }
}
