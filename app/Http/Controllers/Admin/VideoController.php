<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OrderVideoRequest;
use App\Http\Requests\UpdateVideoRequest;

class VideoController extends Controller
{

    public function index(Course $course)
    {
        $videos = Video::videos($course->id);

        $title = 'Sessions';

        $breadcrumbs = 'admin.sessions';

        $breadcrumbArgument = $course;

        $data = compact('videos', 'course', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.videos.index', $data);
    }

    public function create(Course $course)
    {
        $title = $course->name . ' Course Sessions';

        $breadcrumbs = 'admin.sessions';

        $breadcrumbArgument = $course;

        $data = compact('course', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.videos.create', $data);

    }

    public function store(VideoRequest $request, Course $course)
    {

        $video = new Video;

        $video->course_id = $course->id;

        $video->path = $request->video->store('videos/' . $course->slug, 'public');

        $video->title = $request->title;

        $video->price = $request->price;

        $video->order = Video::order($course->id);

        $video->duration = $request->duration;

        $video->description = $request->description;

        $video->save();

        $course->updatePrice();

        $video->pay()->create();

        $target = $request->target;

        return response()->json(compact('target', 'video'));

    }

    public function edit(Video $video)
    {

        $title = $video->course->name . ' Course Sessions';

        $breadcrumbs = 'admin.sessions';

        $breadcrumbArgument = $video->course;

        $data = compact('video', 'title', 'breadcrumbs', 'breadcrumbArgument');

        return view('admin.videos.edit', $data);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {

        $data = $request->snapshot;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }

            $data = base64_decode($data);

            if ($data) {

                $im = imagecreatefromstring($data);

                dd($im);
                
                Storage::put('file.jpg', $im);

                //Storage::disk('public')->put('image.png', $im);

                if ($im !== false) {
                    
                    header('Content-Type: image/png');
                    
                    echo imagepng($im);
                    
                    imagedestroy($im);
                    

                } else {
                    throw new \Exception('An error occurred.');
                }
            } else {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $video->title = $request->title;

        $video->price = $request->price;

        $video->description = $request->description;

        $video->duration = $request->duration;

        $video->frame = $request->blob;

        if ($request->hasFile('video')) {

            $video->path = $request->video->store('videos/' . $video->course->slug, 'public');
        }

        $video->save();

        return response()->json(compact('video'));

    }

    public function order(OrderVideoRequest $request)
    {

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
