<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorRequest;
use App\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{

    public function index()
    {

        $instructors = Instructor::all();

        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {

        $instructor = new Instructor;

        return view('admin.instructors.create', compact('instructor'));
    }

    public function store(InstructorRequest $request)
    {

        $request->validated();

        $instructor = new Instructor;

        return $this->saveOrUpdate($request, $instructor);
    }

    public function show(Instructor $instructor)
    {
        
        return view('admin.instructors.show', compact('instructor'));
        
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {

        $request->validated();

        return $this->saveOrUpdate($request, $instructor);

    }

    public function destroy(Instructor $instructor)
    {

        $instructor->delete();
    }

    private function saveOrUpdate(Request $request, Instructor $instructor)
    {
        $instructor->name = $request->name;

        $instructor->about = $request->about;

        if ($request->file('avatar')) {

            $avatar = $request->avatar->store('public/images/instructors');

            $instructor->avatar = str_replace_first('public/', '', $avatar);
        }

        $instructor->save();

        return response()->json([

            'status' => true,

            'redirect' => route('admin.instructors.show', ['instructor' => $instructor]),
        ]);

    }
}
