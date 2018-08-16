<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Level;
use Illuminate\Http\Request;
use App\Filters\CoursesFilter;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->schools = array('American Diploma', 'IGCSE');

        $this->systems = array('Cambridge', 'Edexcel');

        $this->subSystems = array('Al', 'Ol', 'A2', 'AS');
    }

    public function index(CoursesFilter $filters)
    {
        // Get the current subdomain
        $subdomain = \Route::current()->parameter('subdomain');

        

        $query = Course::join('levels', 'levels.id', 'courses.level_id')

        ->join('instructors', 'instructors.id', 'courses.instructor_id')

        ->select('levels.name as level', 'courses.*', 'instructors.name as instructor');

        $courses = $query->filter($filters)->get();
        $levels = Level::all();

        if ($subdomain === 'admin') {
            return view('admin.courses.index', compact('courses','levels'));
        }

       return redirect()->back();

    }

    public function create()
    {

        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;

        $course = new Course;
        
        return view('admin.courses.create', compact('schools', 'systems', 'subSystems', 'course'));
    }

    public function store(CourseRequest $request)
    {

        $validator = $request->validated();

        $course = new Course();

        $course = $this->saveOrUpdate($request, $course);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'redirect' => '/admin/courses/' . $course->slug,
            ]);
        }

        return redirect('admin/courses');

    }


    public function show(Course $course)
    {
        $subdomain = \Route::current()->parameter('subdomain');
        if ($subdomain === 'admin') {

            return view('admin.courses.show', compact('course'));
        }

        return redirect()->back();

    }


    public function edit(Course $course)
    {

        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;

        return view('admin.courses.edit', compact('course', 'schools', 'systems', 'subSystems'));
    }

    public function update(CourseRequest $request, Course $course)
    {

        $request->validated();

        $course = $this->saveOrUpdate($request, $course);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'course' => $course,
            ]);
        }

        return redirect('/admin/courses');
    }
    public function destroy(Course $course)
    {
        $course->delete();
    }

    private function saveOrUpdate(Request $request, Course $course)
    {

        $course->level_id = 1;

        $course->instructor_id = 1;

        $course->name = $request->name;

        $course->description = $request->description;

        $course->school = $request->school;

        if ($request->school === 'IGCSE') {

            $course->sub_system = $request->sub_system;

            $course->system = $request->system;
        
        } else {

            $course->sub_system = null;

            $course->system = null;

        }

        if ($request->file('image')) {

            $image = $request->image->store('public/images/courses');

            $course->image = str_replace_first('public/', '', $image);
        }

        $course->save();

        return $course;
    }
}
