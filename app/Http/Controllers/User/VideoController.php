<?php

namespace App\Http\Controllers\User;

use App\Video;
use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Requests\OrderVideoRequest;
use App\Http\Requests\UpdateVideoRequest;

use App\Http\Controllers\Controller;

class VideoController extends Controller
{

    public function index(Course $course)
    {

        $videos = Video::videos($course->id);;

        return view('admin.videos.index', compact('videos', 'course'));
    }

    public function create(Course $course)
    {

        return view('admin.videos.create', compact('course'));

    }

   
    public function store(VideoRequest $request, Course $course)
    {

        $request->validated();

        $order = Video::order($course->id);

        foreach ($request->videos as $video) {

            $video = (object) $video;
            
            foreach ($request->file('files') as $file) {
                
                if ($file->getClientOriginalName() === $video->original_name) {

                    $path = $file->store('public/videos/' . $course->slug);
                    
                    $path = str_replace_first('public/', '', $path);
    
                    $videoModel = new Video;

                    $videoModel->course_id = $course->id;

                    $videoModel->path = $path;

                    $videoModel->title = $video->title;

                    $videoModel->free = isset($video->free);

                    $videoModel->order = $order++;

                    $videoModel->save();
    
                    break;
                }
            }
        }

        return route('admin.videos.index', ['course' => $course]);

    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        
        $request->validated();

        $video->title = $request->title;

        $video->free = $this->free($request);

        $courseSlug = Course::select('slug')->where('id', $video->id)->first()->slug;

        if($request->has('path_changed') && $request->file('video'))
        {
            $path = $request->video->store('public/videos/' . $courseSlug);

            $video->path = str_replace_first('public/', '', $path);
        }

        $video->save();

        return jsonResponse(true);
    }

    public function order(OrderVideoRequest $request)
    {

        $request->validated();
        
        $order = 1;

        foreach($request->videos as $video)
        {

            $video = (object) $video;

            $free = isset($video->free);
            
            Video::where('id', $video->id)->update([
                'order' => $order,
                'free' => $free
            ]);

            $order++;
        }

        return jsonResponse(true);
    }


    protected function free(Request $request)
    {
        return $request->filled('free') ? true : false;
    }

    public function destroy(Video $video)
    {
        //
    }


}

