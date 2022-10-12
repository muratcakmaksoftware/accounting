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

    public static function getTRDateFormat($date): string
    {
        return Carbon::parse($date)->format('d.m.Y');
    }
}
