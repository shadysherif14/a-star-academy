<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $title = 'Students';

        $breadcrumbs = 'admin.users';

        $users = User::with('level', 'videos')->get();

        return view('admin.users.index', compact('users', 'title', 'breadcrumbs'));
    }

    public function show(User $user)
    {

        $title = 'Students';

        $breadcrumbs = 'admin.users';

        return view('admin.users.show', compact('user', 'title', 'breadcrumbs'));
    }
}
