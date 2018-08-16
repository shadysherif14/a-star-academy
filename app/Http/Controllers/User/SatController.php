<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;

class SatController extends Controller
{
    public function courses($crs){
        $course = Course::where(
            [
                'name' => $crs,
                'school' => 'SAT'
            ])->first();
        $instructor = $course->instructor;
        $intro = $course->intro();
       
        return view('app.courses.show',compact('course','instructor','intro'));
    }
}
