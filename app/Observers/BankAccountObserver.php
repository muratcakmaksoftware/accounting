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
            $bankAccount->bankAccountHistory()->delete();
        }
    }

    /**
     * @param BankAccount $bankAccount
     * @return void
     */
    public function restoring(BankAccount $bankAccount)
    {
        $bankAccount->bankAccountHistory()->onlyTrashed()->restore();
    }
}
