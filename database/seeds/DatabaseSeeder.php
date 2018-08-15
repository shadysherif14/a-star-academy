<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelsSeeder::class,
            InstructorsSeeder::class,
            CoursesSeeder::class,
            //VideosSeeder::class,
        ]);
    }
}
