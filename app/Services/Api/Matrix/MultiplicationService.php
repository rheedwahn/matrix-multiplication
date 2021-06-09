<?php

namespace App\Services\Api\Matrix;

class MultiplicationService
{
    /**
     * ALL alphabets
     */
    const ALPHABETS = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
        6 => 'F',
        7 => 'G',
        8 => 'H',
        9 => 'I',
        10 => 'J',
        11 => 'K',
        12 => 'L',
        13 => 'M',
        14 => 'N',
        15 => 'O',
        16 => 'P',
        17 => 'Q',
        18 => 'R',
        19 => 'S',
        20 => 'T',
        21 => 'U',
        22 => 'V',
        23 => 'W',
        24 => 'X',
        25 => 'Y',
        26 => 'Z',
    ];

    protected $first_matrix;
    protected $second_matrix;
    protected $total;

    /**
     * MultiplicationService constructor.
     */
    public function __construct(array $first_matrix, array $second_matrix)
    {
        $this->first_matrix = $first_matrix;
        $this->second_matrix = $second_matrix;
        $this->total = count($second_matrix[0]);
    }

    public function run(): array
    {
        $result = [];
        foreach($this->first_matrix as $key => $currentRow){
            for($i=0; $i < $this->total; $i++) {
                $currentColumn = $this->arrayShiftKey($this->second_matrix, $i);
                $cellSum = $this->calculateSum($currentRow,$currentColumn);

                $result[$key][] = $this->parseToAlphabet($cellSum);
            }

        }
        return $result;
    }

    /**
     * @param array $array
     * @param int $index
     * @return array
     */
    protected function arrayShiftKey(array $array, int $index): array
    {
        $shifted = [];
        foreach($array as $value) {
            $shifted[] = $value[$index];
        }
        return $shifted;
    }

    /**
     * @param array $row
     * @param array $column
     * @return int
     */
    protected function calculateSum(array $row, array $column): int
    {
        $total = 0;
        for($i=0; $i<count($row); $i++) {
            $total += $row[$i] * $column[$i];
        }
        return $total;
    }

    /**
     * @param int $sum
     * @return mixed|string
     */
    protected function parseToAlphabet(int $sum): string
    {
        $totalCharacters = count(self::ALPHABETS);
        if ($sum < $totalCharacters) {
            return self::ALPHABETS[$sum];
        } else {
            //Get the int to determine the first letter.
            $index = (int) floor($sum / $totalCharacters);
            $alphabet = self::ALPHABETS[$index];
            //Take the remainder and find the index of the second letter.
            $remainder = $sum - ($totalCharacters * $index);
            if($remainder === 0) {
                $alphabet .= 'Z';
            } else {
                $alphabet .= self::ALPHABETS[$remainder];
            }
            return $alphabet;
        }
    }
}
