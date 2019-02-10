<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswersCount implements Rule
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
        
        return count(request('answers')) > 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The answers should be at least two.';
    }
}
