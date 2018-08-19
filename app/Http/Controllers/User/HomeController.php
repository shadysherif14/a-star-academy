<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;
use App\Course;

class HomeController extends Controller
{
    public function index(){

    
        $igGrades = Level::where('name','<>','SAT')->get();
        $satCourses = Course::where('school','SAT')->get();

        return view('app.homepage.index',compact('igGrades','satCourses'));
    }
}
