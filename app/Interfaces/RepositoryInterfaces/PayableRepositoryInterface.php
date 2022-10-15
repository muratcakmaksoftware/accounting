<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Database\Eloquent\Collection;

interface PayableRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function datatables(): Collection;
}
