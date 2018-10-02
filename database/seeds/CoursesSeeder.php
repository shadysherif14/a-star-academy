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

        $description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem minima autem enim blanditiis necessitatibus tempore. Reiciendis commodi quo earum quasi totam aut molestiae non in nam adipisci quaerat, nemo dolore sint. Esse a incidunt consequuntur quam eius officia accusantium ut expedita, fuga quaerat inventore quisquam fugit, delectus numquam harum eveniet.';

        // American SAT

        $courses = ['Math', 'English (Reading)', 'English (Writing)'];

        $slugs = ['math', 'english-reading', 'english-writing'];

        $satLevel = Level::select('id')->where([
            ['school', 'SAT'],
            ['name', 'General'],
        ])->first();

        foreach ($courses as $i => $course) {

            $sat = [
                'level_id' => $satLevel->id,
                'instructor_id' => random_int(1, 10),
                'name' => $course,
                'slug' => 'SAT-' . $slugs[$i],
                'description' => $description,
                'school' => 'SAT',

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
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => 'IG-' . str_slug($course) . '-' . str_slug($level->name),
                        'description' => $description,
                        'school' => 'IGCSE',
                    ];
                    Course::create($data);
                }

            } elseif ($level->name === '9th Grade') {

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology', 'Arabic'];

                foreach ($courses as $course) {
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => 'IG-' . str_slug($course) . '-' . str_slug($level->name),
                        'description' => $description,
                        'school' => 'IGCSE'
                    ];
                    Course::create($data);
                }

            } elseif ($level->name === 'IG') {

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology', 'Arabic'];

                foreach ($courses as $course) {
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'school' => 'IGCSE',
                        'description' => $description,
                    ];
                    foreach ($systems as $sys) {
                        foreach ($subSystems as $sub) {
                            $data['system'] = $sys;
                            $data['sub_system'] = $sub;
                            $data['slug'] = 'IG-' . str_slug($course) . '-' . strtolower($sys) . '-' . strtolower($sub);
                            Course::create($data);
                        }
                    }
                }

            }

        }

    }
}
