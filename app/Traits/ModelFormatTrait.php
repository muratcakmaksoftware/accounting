<?php

namespace App\Traits;

use App\Helpers\FormatHelper;

trait ModelFormatTrait
{
    /**
     * @return string
     */
    public function getPriceFormatTRYAttribute(): string
    {
        return FormatHelper::getCurrencyFormat($this->price);
    }

    /**
     * @return string
     */
    public function getExpiresAtFormatAttribute(): string
    {
        return FormatHelper::getTRDateFormat($this->expires_at);
    }

    /**
     * @return string
     */
    public function getCreatedAtFormatAttribute(): string
    {
        return FormatHelper::getTRDateFormat($this->created_at);
    }

    /**
     * @return string
     */
    public function getUpdatedAtFormatAttribute(): string
    {
        return FormatHelper::getTRDateFormat($this->updated_at);
    }

    /**
     * @return string
     */
    public function getDeletedAtFormatAttribute(): string
    {
        return FormatHelper::getTRDateFormat($this->deleted_at);
    }
}
