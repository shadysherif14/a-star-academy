<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Carbon\Carbon;
use App\Classes\Poster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PosterController extends Controller
{

    public function update(Video $video)
    {

        $video->poster = Poster::generate(request('poster'), $video->course->postersPath);

        $video->save();

        return response()->json(compact('video', 200));
    }
}
