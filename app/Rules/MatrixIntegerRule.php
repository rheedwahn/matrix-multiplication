<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatrixIntegerRule implements Rule
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
        foreach($value as $val) {
            $check = array_filter($val, [$this, 'checkForInteger']);
            if(count($check)) {
                return false;
            }
        }
        return true;
    }

    /**
     * check if the value is an integer
     * @param $value
     * @return mixed
     */
    public function checkForInteger($value)
    {
        if (!is_int($value)) {
            return $value;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "The :attribute must only contain integers(whole numbers).";
    }
}
