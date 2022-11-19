<?php

namespace App\Observers;

use App\Models\Bank;

class BankObserver
{
    /**
     * @param Bank $bank
     * @return void
     */
    public function deleting(Bank $bank)
    {
        if (!$bank->isForceDeleting()) {
            $bank->bankAccounts()->delete();
        }
    }

    /**
     * @param Bank $bank
     * @return void
     */
    public function restoring(Bank $bank)
    {
        $bank->bankAccounts()->onlyTrashed()->restore();
    }
}
