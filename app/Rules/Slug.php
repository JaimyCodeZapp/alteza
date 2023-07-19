<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Slug implements Rule
{
    /**
     * Check if the slug is valid (lowercase letters, numbers, hyphens, and underscores)
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-z0-9_-]+$/', $value) === 1;
    }

    public function message()
    {
        return 'The :attribute must be lowercase and have no spaces.';
    }
}