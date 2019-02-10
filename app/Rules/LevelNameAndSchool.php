<?php

namespace App\Rules;

use App\Level;
use Illuminate\Contracts\Validation\Rule;

class LevelNameAndSchool implements Rule
{

    private $school, $name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($school, $name, $levelID = null)
    {

        $this->school = $school;

        $this->name = $name;

        $this->levelID = $levelID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $level = Level::where([
            ['name', $this->name],
            ['school', $this->school],
        ])->first();

        if($this->levelID) {

            return is_null($level) || $level->id == $this->levelID;
        }
        
        return is_null($level);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is a level has the same combination of name and school.';
    }
}
