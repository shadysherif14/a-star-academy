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

        $title = 'Instructors';

        $breadcrumbs = 'admin.instructors';

        return view('admin.instructors.index', compact('instructors', 'title', 'breadcrumbs'));
    }

    public function create()
    {

        $instructor = new Instructor;

        $title = 'Instructors';

        $breadcrumbs = 'admin.instructors.add';

        $data = compact('instructor', 'title', 'breadcrumbs');

        return view('admin.instructors.create', $data);
    }

    public function store(InstructorRequest $request)
    {

        $instructor = new Instructor;

        return $this->persist($request, $instructor);
    }

    public function show(Instructor $instructor)
    {

        $title = $instructor->name;

        $breadcrumbs = 'admin.instructor';

        $breadcrumbArgument = $instructor;

        $data = compact('instructor', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.instructors.show', $data);
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {

        $request->validated();

        return $this->persist($request, $instructor);

    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
    }

    private function persist(Request $request, Instructor $instructor)
    {

        $columns = ['name', 'email', 'about'];

        foreach ($columns as $column) {

            $instructor->$column = $request->$column;
        }

        if ($request->hasFile('avatar')) {
            $instructor->avatar = $request->avatar->store('images/instructors', 'public');
        }

        if ($request->filled('password')) {
            $instructor->password = bcrypt($request->password);
        }

        if ($request->filled('accounts')) {
            $instructor->accounts = $request->accounts;
        }

        $instructor->save();

        return response()->json([

            'status' => true,

            'redirect' => route('admin.instructors.show', ['instructor' => $instructor]),
        ]);

    }
}
