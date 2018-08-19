<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserBasicInformationRequest;

class UsersConfigController extends Controller
{

    public function basicInformation(UserBasicInformationRequest $request)
    {

        $request->validated();

        if ($request->school === 'American Diploma' || ($request->school === 'IGCSE' && $request->level !== 'IG')) {
            return jsonResponse(true);
        }

        $status = true;

        $courses = array('Math', 'Physics', 'English', 'Chemistry', 'Biology', 'Arabic');

        return response()->json(compact('status', 'courses'));

    }
}
