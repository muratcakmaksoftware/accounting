<?php

namespace App\Observers;

use App\Models\Payable;
use Carbon\Carbon;

class PayableObserver
{
    /**
     * Handle the Payable "retrieved" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function retrieved(Payable $payable)
    {

    }

    /**
     * Handle the Payable "creating" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function creating(Payable $payable)
    {
        //
    }

    /**
     * Handle the Payable "created" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function created(Payable $payable)
    {
        //
    }


    /**
     * Handle the Payable "creating" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function updating(Payable $payable)
    {
        //
    }

    /**
     * Handle the Payable "updated" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function updated(Payable $payable)
    {
        //
    }

    /**
     * Handle the Payable "deleted" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function deleted(Payable $payable)
    {
        //
    }

    /**
     * Handle the Payable "restored" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function restored(Payable $payable)
    {
        //
    }

    /**
     * Handle the Payable "force deleted" event.
     *
     * @param Payable $payable
     * @return void
     */
    public function forceDeleted(Payable $payable)
    {
        //
    }
}
