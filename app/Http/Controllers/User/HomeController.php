<?php

namespace App\Http\Controllers\User;

use App\Level;
use App\Video;
use App\Course;
use App\Http\Controllers\Controller;
use BaklySystems\PayMob\Facades\PayMob;

class HomeController extends Controller
{
    public function __invoke()
    {

        $paths = Level::with('courses.videos')->get()->groupBy('school')->reverse();

        $schools = collect();

        foreach ($paths as $key => $levels) {

            $courses = $videos = 0;

            foreach ($levels as $level) {

                $courses += $level->courses()->count();

                foreach ($level->courses as $course) {
                
                    $videos += $course->videos()->count();
                }
            }
            
            $schools->push((object) [
                'name' => $key,
                'courses' => $courses,
                'videos' => $videos
            ]);
        }


        $videos = Video::select('duration')->get();
        
        $hours = $minutes = $seconds = 0;

        foreach ($videos as $video) {

            $parsedDuration = explode(':', $video->duration);

            if(sizeof($parsedDuration) === 3) {
                $hours += $parsedDuration[0];
                $minutes += $parsedDuration[1];
                $seconds += $parsedDuration[2];
            } else if(sizeof($parsedDuration) === 2) {
                $minutes += $parsedDuration[0];
                $seconds += $parsedDuration[1];
            } else {
                $seconds += $parsedDuration[0];
            }
        }
        $minutes += round($seconds / 60);
        $hours += round($minutes / 60);

        $courses = Course::count();

        return view('user.home', compact('schools', 'hours', 'courses'));
    }
}
