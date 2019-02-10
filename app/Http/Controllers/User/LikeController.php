<?php

namespace App\Http\Controllers\User;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cog\Likeable\Contracts\Likeable;

class LikeController extends Controller
{
    
    public function course(Course $course) {

        $course->toggleLikeBy();

        return response()->json([], 200);
    }
}
