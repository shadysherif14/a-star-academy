<?php

namespace App\Http\Controllers\User;

use App\Level;
use App\Course;
use App\Instructor;
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
            dd(auth());
            return view('admin.courses.index', compact('courses','levels'));
        }

        return view('app.courses.index', compact('courses','levels'));

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

        $levels = Level::select('id', 'name')->get();

        return view('admin.courses.edit', compact('course', 'schools', 'systems', 'subSystems', 'levels'));
    }

    public function update(CourseRequest $request, Course $course)
    {

        $request->validated();

        $course = $this->saveOrUpdate($request, $course);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'redirect' => '/admin/courses/' . $course->slug,
            ]);
        }

        return redirect('/admin/courses');
    }
    
    public function destroy(Course $course)
    {
        $course->delete();

        return jsonResponse(true);

    }

    private function saveOrUpdate(Request $request, Course $course)
    {
                
        $course->level_id = $request->level;

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
        
        } else if($course->image && $request->removed === 'true') {

            $course->image = 'images/defaults/course.png';
        }

        $course->save();

        return $course;
    }
}
