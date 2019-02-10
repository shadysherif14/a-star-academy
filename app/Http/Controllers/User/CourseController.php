<?php

namespace App\Http\Controllers\User;

use App\Level;
use App\Course;
use Illuminate\Http\Request;
use App\Filters\CoursesFilter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function index(Request $request)
    {


        $query = Course::query();

        if (Auth::check()) {
            $user = Auth::user();
            $query = Course::whereLevelId($user->level_id);
        }
        
        if($request->filled('school')) {
            $query->whereSchool($request->school);
        } elseif($request->filled('level')) {
            $level = Level::whereName($request->level)->first();
            $query->whereLevelId($level->id);
        } elseif($request->filled('system')) {
            $query->whereSystem($request->system);
        } elseif($request->filled('sub_system')) {
            $query->whereSubSystem($request->sub_system);
        }

        $courses = $query->with('level')->get();

        if($request->ajax()) {
            return response()->json(compact('courses'));
        }

        return view('user.courses.index', compact('courses'));
    }

    public function school($school)
    {


        if (Auth::check()) {

            $user = Auth::user();

            $query = $query->where('level_id', $user->level_id);
        }

        $courses = $query->get();

        return view('user.courses.index', compact('courses'));
    }

    public function level($school)
    {

        $query = Course::whereSchool($school);

        if (Auth::check()) {

            $user = Auth::user();

            $query = $query->where('level_id', $user->level_id);
        }

        $courses = $query->get();

        return view('user.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {

        if (Auth::check() && Auth::user()->level_id !== $course->level_id) {

            abort(404);
        }

        $course->load(['instructor', 'videos']);

        $videos = $course->videos;

        return view('user.courses.show', compact('course', 'videos'));
    }
}
