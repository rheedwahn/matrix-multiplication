<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FullMatrixRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if( count($value) !== 1) {
            $currentLength = count($value[0]);
            for($i=0; $i < count($value); $i++) {
                count($value[$i]) !== $currentLength ?: false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "The :attribute must not contain an empty or null values.";
    }
}
