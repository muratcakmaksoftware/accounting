<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function updating(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function saving(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function saved(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function deleting(User $user)
    {
        if($user->isForceDeleting()) {

        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function restoring(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {

    }

    /**
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {

    }
}
