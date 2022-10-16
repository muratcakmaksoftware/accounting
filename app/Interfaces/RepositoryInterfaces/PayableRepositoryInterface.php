<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface PayableRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function datatables(): Collection;
}
