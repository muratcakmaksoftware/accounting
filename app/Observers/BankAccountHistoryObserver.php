<?php

namespace App\Observers;

use App\Models\BankAccountHistory;

class BankAccountHistoryObserver
{
    /**
     * @param BankAccountHistory $bankAccountHistory
     * @return void
     */
    public function created(BankAccountHistory $bankAccountHistory)
    {
        $bankAccountHistory->bankAccount()->increment('balance', $bankAccountHistory->total);
    }

    /**
     * @param BankAccountHistory $bankAccountHistory
     * @return void
     */
    public function deleted(BankAccountHistory $bankAccountHistory)
    {
        $bankAccountHistory->bankAccount()->decrement('balance', $bankAccountHistory->total);
    }

    /**
     * @param BankAccountHistory $bankAccountHistory
     * @return void
     */
    public function restored(BankAccountHistory $bankAccountHistory)
    {
        $bankAccountHistory->bankAccount()->increment('balance', $bankAccountHistory->total);
    }
}
