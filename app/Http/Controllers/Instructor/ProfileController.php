<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Classes\CroppedImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorUpdateRequest;
use App\Http\Requests\InstructorProfileUpdateRequest;

class ProfileController extends Controller
{
    
    public function show()
    {
        $instructor = auth()->user();

        $title = 'Profile';

        $breadcrumbs = 'admin.profile';

        return view('instructor.profiles.show', compact('instructor', 'title', 'breadcrumbs'));
    }


    public function update(InstructorUpdateRequest $request)
    {

        $instructor = auth()->user();

        $columns = ['name', 'email', 'about', 'phone'];

        foreach ($columns as $column) {
            $instructor->$column = $request->$column;
        }

        if ($request->hasFile('avatar')) {
            $instructor->avatar = CroppedImage::create($request->file('avatar'), 'images/avatars/instructors', $instructor->username);
        }

        if ($request->filled('password')) {
            $instructor->password = bcrypt($request->password);
        }

        if ($request->filled('accounts')) {

            // Filter blank accounts
            $accounts = collect($request->accounts)->filter();

            $instructor->accounts = $accounts;
        }


        $instructor->save();

        return response()->json([

            'status' => true,

            'redirect' => route('instructor.home'),
        ]);

    }
}
