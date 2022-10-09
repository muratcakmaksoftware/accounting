<?php

namespace App\Helpers;

class CalculationHelper
{
    /**
     * @param float $min
     * @param float $max
     * @param int $digit
     * @return float|int
     */
    public static function randomDecimal(float $min, float $max, int $digit = 2): float|int
    {
        return mt_rand($min * 10, $max * 10) / pow(10, $digit);
    }
}
