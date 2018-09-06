<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $levelsGeneral = ['General'];
        $levelsSAT = ['General'];
        $levelsIG = ['8th Grade', '9th Grade', 'IG'];

        $description = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid voluptas vero expedita similique autem saepe odio, officiis esse reiciendis porro enim quisquam incidunt quos praesentium iste officia distinctio neque, repellendus quae adipisci? Omnis, quod reiciendis a commodi, debitis enim doloribus asperiores, nulla consectetur deserunt molestiae. Ut placeat vero adipisci voluptatibus.';

        foreach ($levelsGeneral as $levelGeneral) {

            $level = new Level;

            $level->name = $levelGeneral;

            $level->school = 'General';

            $level->description = $description;

            $level->save();
        }

        foreach ($levelsSAT as $levelSAT) {

            $level = new Level;

            $level->name = $levelSAT;

            $level->school = 'SAT';

            $level->description = $description;

            $level->save();
        }

        foreach ($levelsIG as $levelIG) {

            $level = new Level;

            $level->name = $levelIG;

            $level->school = 'IGCSE';

            $level->description = $description;

            $level->save();
        }
    }
}
