<?php

namespace App\Http\Controllers\Instructor;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    
    public function index()
    {
        
        $instructor = Auth::guard('instructor')->user();

        $courses = $instructor->courses;

        $title = 'Courses';

        $breadcrumbs = 'admin.courses';
        
        return view('instructor.courses.index', compact('courses', 'title', 'breadcrumbs'));
        
    }

    public function show(Course $course)
    {

        $course->load(['instructor', 'level', 'videos.users', 'subscriptions']);

        $data['course'] = $course;

        $data['title'] = $course->name;

        $data['breadcrumbs'] = 'admin.course';

        $data['breadcrumbArgument'] = $course;

        return view('instructor.courses.show', $data);
    }
}
