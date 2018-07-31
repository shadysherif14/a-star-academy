<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use App\Http\Requests\InstructorRequest;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $instructors = Instructor::all();

        return view('admin.instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.instructors.create');
    }


    public function store(InstructorRequest $request)
    {
        
        $request->validated();

        $instructor = new Instructor;

        $instructor = $this->saveOrUpdate($request, $instructor);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'instructor' => $instructor,
            ]);
        }

        return redirect('instructors');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

 
    public function destroy(Instructor $instructor)
    {
        
    }

    private function saveOrUpdate(Request $request, Instructor $instructor)
    {
        $instructor->name = $request->name;

        $instructor->about = $request->about;

        $image = $request->avatar->store('/images/avatars');

        $instructor->avatar = $image;

        $instructor->save();

        return $instructor;
    }
}
