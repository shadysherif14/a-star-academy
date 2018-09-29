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
        $this->schools = Level::select('school')->get()->unique('school')->pluck('school');

        $this->systems = array('Cambridge', 'Edexcel');

        $this->subSystems = array('AL', 'OL', 'A2', 'AS');
    }

    public function index(CoursesFilter $filters)
    {

        $query = Course::join('levels', 'levels.id', 'courses.level_id')

            ->join('instructors', 'instructors.id', 'courses.instructor_id')

            ->select('levels.name as level', 'courses.*', 'instructors.name as instructor');

        $courses = $query->filter($filters)->get();

        $data = $this->prepareData();

        $data['courses'] = $courses;

        if (request()->ajax()) {

            return response()->json(compact('courses'));
        }

        $data['title'] = 'Courses';

        $data['breadcrumbs'] = 'admin.courses';

        return view('admin.courses.index', $data);
    }

    public function create()
    {

        $course = new Course;

        $data = $this->prepareData();

        $data['course'] = $course;

        $data['title'] = 'Add Courses';

        $data['breadcrumbs'] = 'admin.courses.add';

        $data['endPoint'] = Course::adminRoutes()->store;

        return view('admin.courses.create', $data);
    }

    public function store(CourseRequest $request)
    {

        $validator = $request->validated();

        $course = new Course();

        return $this->persist($request, $course);
    }

    public function show(Course $course)
    {

        $data['course'] = Course::where('courses.id', $course->id)

            ->with(['instructor', 'level'])

            ->first();

        $data['title'] = $course->name;

        $data['breadcrumbs'] = 'admin.course';

        $data['breadcrumbArgument'] = $course;
        

        return view('admin.courses.show', $data);
    }

    public function edit(Course $course)
    {

        $data = $this->prepareData();

        $data['course'] = $course;

        $data['title'] = 'Edit Course';

        $data['breadcrumbs'] = 'admin.course';

        $data['breadcrumbArgument'] = $course;

        $data['endPoint'] = $course->adminRoutes->update;

        return view('admin.courses.edit', $data);
    }

    public function update(CourseRequest $request, Course $course)
    {

        $request->validated();

        return $this->persist($request, $course);

    }
    public function destroy(Course $course)
    {
        $course->delete();
    }

    private function persist(Request $request, Course $course)
    {

        $course->level_id = $request->level;

        $course->instructor_id = $request->instructor;

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

    private function prepareData()
    {
        $schools = $this->schools;

        $systems = $this->systems;

        $subSystems = $this->subSystems;

        $levels = Level::select('id', 'name', 'school')->get();

        $instructors = Instructor::select('id', 'name')->get();

        $data = compact('schools', 'systems', 'subSystems', 'levels', 'instructors');

        return $data;
    }
}
