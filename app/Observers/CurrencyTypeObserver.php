<?php

namespace App\Observers;

use App\Models\CurrencyType;

class CurrencyTypeObserver
{
    /**
     * @param CurrencyType $currencyType
     * @return void
     */
    public function deleting(CurrencyType $currencyType)
    {
        if (!$currencyType->isForceDeleting()) {
            $currencyType->payables()->delete();
            $currencyType->receivables()->delete();
            $currencyType->bankCurrencyTotals()->delete();
        }
    }

    /**
     * @param CurrencyType $currencyType
     * @return void
     */
    public function restoring(CurrencyType $currencyType)
    {
        $currencyType->payables()->onlyTrashed()->restore();
        $currencyType->receivables()->onlyTrashed()->restore();
        $currencyType->bankCurrencyTotals()->onlyTrashed()->restore();
    }
}
