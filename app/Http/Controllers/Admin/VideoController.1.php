<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Poster;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderVideoRequest;
use App\Http\Requests\VideoRequest;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function index(Course $course)
    {

        $videos = $course->videos;

        $title = 'Sessions';

        $breadcrumbs = 'admin.sessions';

        $breadcrumbArgument = $course;

        $data = compact('videos', 'course', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.videos.index', $data);
    }

    public function create(Course $course)
    {
        $title = $course->name . ' Course Sessions';

        $breadcrumbs = 'admin.sessions.add';

        $breadcrumbArgument = $course;

        $path = "public/$course->videosPath";

        $videos = collect(Storage::files($path))->map(function ($video) use ($path) {
            return str_after($video, "$path/");
        });

        $data = compact('course', 'title', 'breadcrumbs', 'breadcrumbArgument', 'videos');

        return view('admin.videos.create', $data);

    }

    public function store(VideoRequest $request, Course $course)
    {


        $video = new Video;

        $video->course_id = $course->id;

        $video->path = "$course->videosPath/$request->video";

        $video->title = $request->title;

        if ($request->filled('overview') && $request->overview == "1") {

            $video->overview = true;

        } else {

            $video->max_price = $request->max_price;

            $video->max_times = $request->max_times;

            $video->one_price = $request->one_price;
        }

        $video->order = Video::order($course->id);

        $video->duration = gmdate("H:i:s", round($request->duration));

        $video->description = $request->description;

        if ($request->filled('poster')) {
            $video->poster = Poster::generate(request('poster'), $video->course->postersPath);
        }

        $video->save();

        return response()->json(array('redirect' => route('admin.courses.show', $course)));

    }

    public function edit(Video $video)
    {

        $title = $video->course->name . ' Course Sessions';

        $breadcrumbs = 'admin.sessions.edit';

        $breadcrumbArgument = $video->course;

        $course = $video->course;

        $path = "public/$course->videosPath";

        $videos = collect(Storage::files($path))->map(function ($video) use ($path) {
            return str_after($video, "$path/");
        });

        $data = compact('video', 'course', 'videos', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.videos.edit', $data);
    }

    public function update(VideoRequest $request, Video $video)
    {

        $video->title = $request->title;

        if (!$video->isOverview()) {

            $video->max_price = $request->max_price;

            $video->max_times = $request->max_times;

            $video->one_price = $request->one_price;
        }

        $video->description = $request->description;

        if ($request->filled('duration')) {
            $video->duration = gmdate("H:i:s", round($request->duration));
        }

        if ($request->filled('poster')) {

            $path = Poster::generate($request->poster, $video->course->postersPath);

            $video->poster = $path;
        }

        if ($request->hasFile('video')) {

            $video->path = $request->file('video')

                ->store($video->course->videosPath, 'public');

        }

        $video->save();

        return response()->json(compact('video'));

    }

    public function order(OrderVideoRequest $request)
    {

        $order = 1;

        foreach ($request->videos as $video) {

            $video = (object) $video;

            Video::whereId($video->id)->update([
                'order' => $order,
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
