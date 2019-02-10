<?php

use App\Course;
use App\Level;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // American SAT

        $courses = ['Math', 'English (Reading)', 'English (Writing)'];

        $slugs = ['math', 'english-reading', 'english-writing'];

        $images = ['math', 'english', 'english'];

        $satLevel = Level::select('id')->where([
            ['school', 'SAT'],
            ['name', 'General'],
        ])->first();

        foreach ($courses as $i => $course) {

            $sat = [
                'level_id' => $satLevel->id,
                'instructor_id' => random_int(1, 10),
                'name' => $course,
                'slug' => 'sat-' . $slugs[$i],
                'school' => 'SAT',
                'image' => "images/courses/{$images[$i]}.png",
            ];
            Course::create($sat);
        }

        // IGCSE

        $systems = array('Cambridge', 'Edexcel');

        $subSystems = array('Al', 'Ol', 'A2', 'AS');

        $levels = Level::all();

        foreach ($levels as $level) {

            if ($level->name === '8th Grade') {

                $courses = ['Math', 'Science', 'English', 'Arabic'];

                foreach ($courses as $course) {

                    $image = strtolower($course);

                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => 'ig-' . str_slug($course) . '-' . str_slug($level->name),
                        'school' => 'IGCSE',
                        'image' => "images/courses/{$image}.png"

                    ];
                    Course::create($data);
                }

            } elseif ($level->name === '9th Grade') {

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology', 'Arabic'];

                foreach ($courses as $course) {

                    $image = strtolower($course);

                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => 'ig-' . str_slug($course) . '-' . str_slug($level->name),
                        'school' => 'IGCSE',
                        'image' => "images/courses/{$image}.png"

                    ];
                    Course::create($data);
                }

            } elseif ($level->name === 'IG') {

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology', 'Arabic'];

                foreach ($courses as $course) {

                    $image = strtolower($course);

                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'school' => 'IGCSE',
                        'image' => "images/courses/{$image}.png"
                    ];
                    foreach ($systems as $sys) {

                        foreach ($subSystems as $sub) {

                            $data['system'] = $sys;
                            $data['sub_system'] = $sub;
                            $data['slug'] = 'ig-' . str_slug($course) . '-' . strtolower($sys) . '-' . strtolower($sub);
                            Course::create($data);
                        }
                    }
                }

            }

        }

    }
}
