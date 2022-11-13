<?php

namespace App\Observers;

use App\Models\PaymentMethodType;

class PaymentMethodTypeObserver
{
    /**
     * @param PaymentMethodType $paymentMethodType
     * @return void
     */
    public function deleting(PaymentMethodType $paymentMethodType)
    {
        if (!$paymentMethodType->isForceDeleting()) {
            $paymentMethodType->payables()->delete();
            $paymentMethodType->receivables()->delete();
        }
    }

    /**
     * @param PaymentMethodType $paymentMethodType
     * @return void
     */
    public function restoring(PaymentMethodType $paymentMethodType)
    {
        $paymentMethodType->payables()->onlyTrashed()->restore();
        $paymentMethodType->receivables()->onlyTrashed()->restore();
    }
}
