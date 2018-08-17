<?php

namespace App\Filters;

use App\Instructor;
use App\Level;

class CoursesFilter extends Filter
{

    protected $filters = ['name', 'school', 'system', 'sub_system', 'level', 'instructor'];


    public function name($name)
    {

        return $this->query->where('name', $name);
    }

    public function school($school)
    {
        if ($school === 'ad') {
            $school = 'American Diploma';
        } else if ($school === 'ig') {
            $school = 'IGCSE';
        }

        return $this->query->where('school', $school);
    }

    public function system($system)
    {

        if(request()->school === 'ad') return $this->query;

        $system = ucfirst($system);

        return $this->query->where('system', $system);
    }

    public function sub_system($sub_system)
    {
        if(request()->school === 'ad') return $this->query;

        $sub_system = strtoupper($sub_system);

        return $this->query->where('sub_system', $sub_system);
    }

    public function level($level)
    {
        $level = Level::where('slug', $level)->first();

        return $this->query->where('level_id', $level->id);
    }

    public function instructor($instructor)
    {
        $instructor = Instructor::where('slug', $instructor)->first();

        return $this->query->where('instructor_id', $instructor->id);
    }
}
