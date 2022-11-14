<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface BankRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function datatables(): Collection;

    /**
     * @return Collection
     */
    public function trashedDatatables(): Collection;
}
