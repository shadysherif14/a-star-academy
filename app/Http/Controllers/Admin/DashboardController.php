<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Course;
use App\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $students = User::count();
        
        $instructors = Instructor::count();
        
        $courses = Course::count();

        $title = config('app.name');

        $breadcrumbs = 'admin.home';

        $data = compact('students', 'instructors', 'courses', 'title', 'breadcrumbs');

        return view('admin.index', $data);
    }
}
