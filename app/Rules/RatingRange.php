<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RatingRange implements Rule
{
    /**
     * Check if the rating is between 1 - 10
     */
    public function passes($attribute, $value)
    {
        return $value >= 1 && $value <= 10;
    }

    public function message()
    {
        return 'The :attribute must be between 1 and 10.';
    }
}