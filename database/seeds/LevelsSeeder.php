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

        $levelsSAT = ['General'];
        $levelsIG = ['8th Grade', '9th Grade', 'IG'];

        foreach ($levelsSAT as $levelSAT) {

            $level = new Level;

            $level->name = $levelSAT;

            $level->school = 'SAT';

            $level->save();
        }

        foreach ($levelsIG as $levelIG) {

            $level = new Level;

            $level->name = $levelIG;

            $level->school = 'IGCSE';

            $level->save();
        }
    }
}
