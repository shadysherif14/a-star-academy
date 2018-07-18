<?php

namespace App\Http\Controllers;

use App\Course;
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
        $courses = Course::all();

        return view('courses.index');
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

        if ($this->validateDate($request) === false) {

            return response()->json([
                'status' => false,
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
        ]);

        if ($validator->fails()) {

            return false;
        }

        return true;
    }

    private function saveOrUpdate(Request $request, Course $course)
    {
        $course->level_id = $request->level_id;

        $course->name = $request->name;

        $course->slug = str_slug($request->name);

        $course->description = $request->description;

        $course->save();

        return $course;
    }
}
