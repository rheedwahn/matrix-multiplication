<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatrixRangeRule implements Rule
{
    /** @var int */
    protected $min;

    /** @var int */
    protected $max;

    /**
     * Create a new rule instance.
     * @param int $min The minimum for the range
     *  @param int $max The maximum for the range
     *
     * @return void
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
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
        foreach($value as $val) {
            $check = array_filter($val, [$this, 'checkRange']);
            if(count($check)) {
                return false;
            }
        }
        return true;
    }

    /**
     * check the range of the inputted value
     * @param int $value
     * @return int
     */
    public function checkRange(int $value)
    {
        if( ($value < $this->min) || ($value > $this->max)) {
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
        return "The :attribute must contain numbers between {$this->min} and {$this->max} only";
    }
}
