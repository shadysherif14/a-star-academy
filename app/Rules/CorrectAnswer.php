<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CorrectAnswer implements Rule
{
    

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $answers = collect(request('answers'))->pluck('body');

        return in_array($value, $answers->toArray());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The correct answer must be one of the answers.';
    }
}
