<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Filters\CoursesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Instructor;
use App\Level;
use Illuminate\Http\Request;

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

        $query = Course::join('levels', 'levels.id', 'courses.level_id')

            ->join('instructors', 'instructors.id', 'courses.instructor_id')

            ->select('levels.name as level', 'courses.*', 'instructors.name as instructor');

        $courses = $query->filter($filters)->get();

        $instructors = Instructor::select('id', 'name')->get();

        $levels = Level::select('id', 'name')->get();

        return view('admin.courses.index', compact('courses', 'levels', 'instructors'));
    }

    public function create()
    {

        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;

        $levels = Level::select('id', 'name')->get();

        $course = new Course;

        return view('admin.courses.create', compact('schools', 'systems', 'subSystems', 'course', 'levels'));
    }

    public function store(CourseRequest $request)
    {

        $validator = $request->validated();

        $course = new Course();

        return $this->saveOrUpdate($request, $course);
    }

    public function show(Course $course)
    {

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {

        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;

        $levels = Level::select('id', 'name')->get();

        return view('admin.courses.edit', compact('course', 'schools', 'systems', 'subSystems', 'levels'));
    }

    public function update(CourseRequest $request, Course $course)
    {

        $request->validated();

        return $this->saveOrUpdate($request, $course);

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

        return response()->json([

            'status' => true,

            'redirect' => route('admin.courses.show', ['course' => $course]),
        ]);

    }
}
