<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Database\Eloquent\Collection;

interface PayableRepositoryInterface
{
    /**
     * @return Collection
     */
    public function datatables(): Collection;
}
