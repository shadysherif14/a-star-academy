<?php

namespace App\Http\Controllers\User;

use App\Instructor;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{

    public function index()
    {
        $instructors = Instructor::all();

        return view('user.instructors.index', compact('instructors'));
    }
    
    public function show(Instructor $instructor)
    {
        $instructor->load('courses');

        return view('user.instructors.show', compact('instructor'));
    }
}
