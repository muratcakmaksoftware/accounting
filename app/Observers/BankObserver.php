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
            foreach ($bank->bankAccounts()->get() as $bankAccount) {
                $bankAccount->delete();
            }
        }
    }

    /**
     * @param Bank $bank
     * @return void
     */
    public function restoring(Bank $bank)
    {
        foreach ($bank->bankAccounts()->onlyTrashed()->get() as $bankAccount) {
            $bankAccount->restore();
        }
    }
}
