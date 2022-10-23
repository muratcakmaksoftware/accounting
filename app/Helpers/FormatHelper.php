<?php

namespace App\Helpers;

use Carbon\Carbon;
use NumberFormatter;

class FormatHelper
{
    /**
     * @param float $price
     * @param string $locale
     * @param string $currency
     * @return string
     */
    public static function getCurrencyFormat(float $price, string $locale = 'tr_TR', string $currency = 'TRY'): string
    {
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($price, $currency);
    }

    /**
     * @param $date
     * @param $format
     * @return string
     */
    public static function getDateFormat($date, string $format = 'd.m.Y'): string
    {
        return Carbon::parse($date)->format($format);
    }

    /**
     * @param string $price
     * @return float
     */
    public static function getCurrencyFormInputFix(string $price): float
    {
        $str = preg_replace('/[^0-9.]+/', '', $price);
        if (($pos = strpos($str, '.')) !== false) {
            $price = substr($str, 0, $pos+1).str_replace('.', '', substr($str, $pos+1));
        }
        return $price;
    }
}
