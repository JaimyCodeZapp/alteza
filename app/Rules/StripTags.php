<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StripTags implements Rule
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
        if($value != strip_tags($value)) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must not contain HTML tags.';
    }
}