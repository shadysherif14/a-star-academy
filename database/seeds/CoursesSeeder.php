<?php

use App\Level;
use App\Course;
use Faker\Factory as Faker;
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

        $faker = Faker::create();

        $schools = array('American Diploma', 'IGCSE');

        $systems = array('Cambridge', 'Edexcel');

        $subSystems = array('Al', 'Ol', 'A2', 'AS');

        $levels = Level::all();

        $courses = ['Mathematics', 'Physics', 'English', 'Chemistry', 'Biology'];

        foreach ($levels as $level) {

            foreach ($courses as $course) {

                $data = [
                    'level_id' => $level->id,
                    'instructor_id' => 1,
                    'name' => $course,
                    'slug' => str_slug($course) . $level->id,
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae doloribus impedit incidunt. Et, repudiandae itaque hic tenetur incidunt eius deserunt sit nostrum architecto laborum sint molestias, nobis neque mollitia soluta?',
                ];

                $school = $faker->randomElement($schools);

                $data['school'] = $school;

                if ($school == 'IGCSE') {

                    $data['system'] = $faker->randomElement($systems);
                    
                    $data['sub_system'] = $faker->randomElement($subSystems);
                }
                else {
                    
                    $data['system'] = null;
                    
                    $data['sub_system'] = null;
                }

                $coursesData[] = $data;
            }
        }

        Course::insert($coursesData);
    }
}
