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

        //$faker = Faker::create();

        //$schools = array('Pre-IGCSE','SAT', 'IGCSE');

        $systems = array('Cambridge', 'Edexcel');

        $subSystems = array('Al', 'Ol', 'A2', 'AS');

        $levels = Level::all();



        // American SAT

        $courses = ['Math','English (Reading)','English (Writing)'];
        $slugs = ['math','english-reading','english-writing'];

        foreach($courses as $i=>$course){
            $sat = [
                'level_id' => 7,
                'instructor_id' => random_int(1, 10),
                'name' => $course,
                'slug' => $slugs[$i],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae doloribus impedit incidunt. Et repudiandae itaque hic tenetur incidunt eius deserunt sit nostrum architecto laborum sint molestias nobis neque mollitia soluta?',
                'school' => 'SAT',
                'system' => null,
                'sub_system' => null,
            
            ];
            Course::insert($sat);
        }
        
        
        

        // IGCSE
        
        foreach ($levels as $level) {
            
            if ($level->name === '8th Grade'){

                $courses = ['Math', 'Science', 'English', 'Arabic'];
                $data['school'] = 'Pre-IGCSE';
                $data['system'] = null;
                $data['sub_system'] = null;
                foreach($courses as $course){
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => str_slug($course) . $level->id,
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae doloribus impedit incidunt. Et repudiandae itaque hic tenetur incidunt eius deserunt sit nostrum architecto laborum sint molestias nobis neque mollitia soluta?',
                    ];
                    Course::insert($data);
                }
                
                
            }
            
            elseif($level->name === '9th Grade'){

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology','Arabic'];
                $data['school'] = 'Pre-IGCSE';
                $data['system'] = null;
                $data['sub_system'] = null;
                foreach($courses as $course){
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'slug' => str_slug($course) . $level->id,
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae doloribus impedit incidunt. Et repudiandae itaque hic tenetur incidunt eius deserunt sit nostrum architecto laborum sint molestias nobis neque mollitia soluta?',
                    ];
                    Course::insert($data);
                }

            }

            elseif($level->name === 'IG'){

                $courses = ['Math', 'Physics', 'English', 'Chemistry', 'Biology','Arabic'];
                
                foreach($courses as $course){
                    $data = [
                        'level_id' => $level->id,
                        'instructor_id' => random_int(1, 10),
                        'name' => $course,
                        'school' => 'IGCSE',
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae doloribus impedit incidunt. Et repudiandae itaque hic tenetur incidunt eius deserunt sit nostrum architecto laborum sint molestias nobis neque mollitia soluta?',
                    ];
                    foreach($systems as $sys){
                        foreach($subSystems as $sub){
                            $data['system']      = $sys;
                            $data['sub_system']  = $sub;
                            $data['slug']        = str_slug($course) .'-'. $sys .'-'. $sub .'-';

                            Course::insert($data);
                        }
                    }
                }
                
            }
        
            
            }
        

        
        
    }
}
