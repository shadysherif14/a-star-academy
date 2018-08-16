<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $levels = ['8th Grade', '9th Grade', 'SAT', 'IG'];

        foreach($levels as $level) {

            $levelsData[] = [
                'name' => $level,
                'slug' => str_slug($level),
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae totam impedit et eius incidunt, exercitationem quia corporis ducimus veniam ratione nemo aperiam cupiditate quisquam repellendus illo sequi adipisci est, reiciendis dolore. Nihil blanditiis voluptate, amet quo aspernatur, non numquam excepturi temporibus cum quas corrupti, ipsam voluptates. Laborum id consectetur reiciendis?',
            ];
        }
        Level::insert($levelsData);
    }
}
