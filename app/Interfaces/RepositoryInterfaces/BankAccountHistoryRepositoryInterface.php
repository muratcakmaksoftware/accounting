<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface BankAccountHistoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $bankAccountId
     * @return Collection
     */
    public function datatables($bankAccountId): Collection;

    /**
     * @param $bankAccountId
     * @return Collection
     */
    public function trashedDatatables($bankAccountId): Collection;
}
