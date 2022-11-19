<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface BankAccountRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $bankId
     * @return Collection
     */
    public function datatables($bankId): Collection;

    /**
     * @param $bankId
     * @return Collection
     */
    public function trashedDatatables($bankId): Collection;
}
