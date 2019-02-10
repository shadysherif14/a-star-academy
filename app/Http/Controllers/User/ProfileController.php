<?php

namespace App\Http\Controllers\User;

use App\Classes\CroppedImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show()
    {

        $user = Auth::user();
        
        $user->load('quizzes.video.course', 'activeVideos');

        return view('user.profiles.show', compact('user'));

    }

    public function edit()
    {
        $user = Auth::user();

        return view('user.profiles.edit', compact('user'));
    }

    public function update(ProfileUpdate $request)
    {
        $user = Auth::user();

        $properties = array('first_name', 'last_name', 'username', 'email', 'gender', 'phone');

        foreach ($properties as $property) {

            if ($request->filled($property)) {

                $user->$property = $request->$property;
            }
        }

        if ($request->filled('password')) {

            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            $name = "{$user->username}.jpg";

            $user->avatar = $avatar->storeAs('images/avatars/original', $name, 'public');

            $path = 'images/avatars/cropped';

            $user->cropped_avatar = CroppedImage::create($avatar, $path, $name);
        }

        $accounts = collect($request->accounts)->filter();

        $user->accounts = $accounts;

        $user->save();

        return response()->json([]);
    }

}
