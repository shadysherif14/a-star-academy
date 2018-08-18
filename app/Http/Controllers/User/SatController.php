<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\Video;

class SatController extends Controller
{
    public function courses($crs){
        $course = Course::where(
            [
                'slug' => $crs,
                'school' => 'SAT'
            ])->first();
        $instructor = $course->instructor;
        $intro = $course->intro();
        $videos = $course->videos->where('free',0)->sortBy('order');
                
        return view('app.courses.show',compact('course','instructor','intro','videos'));
    }


    public function fetchVideo(Request $request){
        if(request()->ajax()){
            $id = $request->video_id;
            $user = Auth::user();

            $res = DB::table('users_videos')->where([
                'user_id' => $user->id,
                'video_id' => $id
            ])->get();
            if (count($res)){
                $video = Video::find($id);
                return response()->json(["status" => true,'video' => $video]);
            }
            return response()->json(["status" => false]);
        }
        
    }
}
