<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Requests\OrderVideoRequest;
use App\Http\Requests\UpdateVideoRequest;

use App\Http\Controllers\Controller;

class VideoController extends Controller
{

    public function index(Course $course)
    {

        $videos = Video::videos($course->id);

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

        $file = $request->file('video');

        $path = $file->store('public/videos/' . $course->slug);

        $path = str_replace_first('public/', '', $path);

        $video = new Video;

        $video->course_id = $course->id;

        $video->path = $path;

        $video->title = $request->title;

        $video->free = $request->free === 'true';

        $video->order = $order;

        $video->save();

        $status = true;

        $redirect = route('admin.videos.index', ['course' => $course]);

        return response()->json(compact('status', 'redirect'));

    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {

        $request->validated();

        $video->title = $request->title;

        $video->free = $request->has('free');

        $courseSlug = Course::select('slug')->where('id', $video->course_id)->first()->slug;

        if ($request->has('path_changed') && $request->file('video')) {
            $path = $request->video->store('public/videos/' . $courseSlug);

            $video->path = str_replace_first('public/', '', $path);
        }

        $video->save();
        
        $path = $video->path;

        $status = true;

        return response()->json(compact('status', 'path'));

    }

    public function order(OrderVideoRequest $request)
    {

        $request->validated();

        $order = 1;

        foreach ($request->videos as $video) {

            $video = (object) $video;

            $free = isset($video->free);

            Video::where('id', $video->id)->update([
                'order' => $order,
                'free' => $free,
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
        $video->delete();

        return jsonResponse(true);
    }

}
