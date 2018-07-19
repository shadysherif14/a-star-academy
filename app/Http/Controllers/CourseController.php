<?php

namespace App\Http\Controllers;

use App\Course;
use Faker\Generator as Faker;
use App\Level;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $levels = Level::all();
        
        return view('courses.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateDate($request);


        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $course = new Course();

        $course = $this->saveOrUpdate($request, $course);

        return response()->json([
            'status' => true,
            'course' => $course,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {

        return $course;
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if ($this->validateDate($request) === false) {

            return response()->json([
                'status' => false,
            ]);

        }

        $course = $this->saveOrUpdate($request, $course);

        return response()->json([
            'status' => true,
            'course' => $course,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }

    private function validateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|exists:levels,id',
            'name' => 'required',
            'school' => ['required', Rule::in(['ad', 'ig'])],
            'system' => ['required_if:school,ig', Rule::in(['cambridge', 'edxcel'])],
            'subsystem' => ['required_if:school,ig', Rule::in(['a2', 'as', 'al', 'ol'])],
        ]);

        return $validator;

    }

    private function saveOrUpdate(Request $request, Course $course)
    {

        $postSlug = Faker::numerify('###');
        
        $course->level_id = $request->level_id;
        
        $course->name = $request->name;
                
        $course->description = $request->description;

        $course->school = $request->school;

        $course->system = $request->system;

        $course->subsystem = $request->subsystem;

        do {
            
            // Unique slug
            $course->slug = str_slug($request->name) . '-' . $postSlug;

            $exist = Course::find($course->slug);

        } while(!$exists);

        $course->save();

        return $course;
    }
}
