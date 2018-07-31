<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->schools = array('American Diploma', 'IGCSE');

        $this->systems = array('Cambridge', 'Edexcel');

        $this->subSystems = array('Al', 'Ol', 'A2', 'AS');
    }
    public function index()
    {

        $courses = Course::all();

        if (request()->is('admin/*')) {

            return view('admin.courses.index', compact('courses'));
        }

        return view('app.courses.index', compact('courses'));

    }

    public function create()
    {

        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;
        
        return view('admin.courses.create', compact('schools', 'systems', 'subSystems'));
    }

    public function store(CourseRequest $request)
    {

        $validator = $request->validated();

        $course = new Course();

        $course = $this->saveOrUpdate($request, $course);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'course' => $course,
            ]);
        }

        return redirect('admin/courses');

    }


    public function show(Course $course)
    {

        if (request()->is('admin/*')) {

            return view('admin.courses.show', compact('course'));
        }

        return view('courses.show', compact('course'));

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
