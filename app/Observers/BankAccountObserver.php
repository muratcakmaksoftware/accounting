<?php

namespace App\Observers;

use App\Models\BankAccount;

class BankAccountObserver
{
    /**
     * @param BankAccount $bankAccount
     * @return void
     */
    public function deleting(BankAccount $bankAccount)
    {
        if (!$bankAccount->isForceDeleting()) {
            //$bank->bankAccounts()->delete();
        }
    }

    /**
     * @param BankAccount $bankAccount
     * @return void
     */
    public function restoring(BankAccount $bankAccount)
    {
        //$bank->bankAccounts()->onlyTrashed()->restore();
    }
}
