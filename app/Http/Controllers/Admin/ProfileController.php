<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Classes\CroppedImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;

class ProfileController extends Controller
{
    
    public function show()
    {
        $admin = auth()->user();

        $title = 'Profile';

        $breadcrumbs = 'admin.profile';

        return view('admin.profiles.show', compact('admin', 'title', 'breadcrumbs'));
    }


    public function update(AdminProfileUpdateRequest $request)
    {
        $admin = auth()->user();
        
        $admin->name = $request->name;

        $admin->email = $request->email;

        if($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        if($request->hasFile('avatar')) {
            $admin->avatar = CroppedImage::create($request->file('avatar'), 'images/avatars/admins', $admin->username);
        }

        $admin->save();

        return response()->json([
            'status' => true,
            'redirect' => route('admin.home')
        ]);

    }
}
