<?php

namespace App\Http\Requests\Api\Matrix;

use App\Rules\FullMatrixRule;
use App\Rules\MatrixIntegerRule;
use App\Rules\MatrixRangeRule;
use Illuminate\Foundation\Http\FormRequest;

class MatrixMultiplicationRequest extends FormRequest
{
    const MIN = 1;
    const MAX = 26;

    protected $count;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_matrix' => [
                'bail',
                'required',
                'array',
                'min:1',
                new FullMatrixRule(),
                new MatrixIntegerRule(),
                new MatrixRangeRule(self::MIN,self::MAX)
            ],
            'second_matrix' => [
                'bail',
                'required',
                'array',
                'min:1',
                new FullMatrixRule(),
                new MatrixIntegerRule(),
                new MatrixRangeRule(self::MIN,self::MAX),
                $this->validateSize($this->first_matrix)
            ]
        ];
    }

    protected function validateSize($array): string
    {
        if($array && count($array) > 0) {
            return "size:{$this->getMatrixCount($this->first_matrix)}";
        }
        return "";
    }

    protected function getMatrixCount($array)
    {
        return $this->count = count($array[0]);
    }

    public function messages()
    {
        return [
            'size' => "The second matrix must have a row count of {$this->count}"
        ];
    }
}
