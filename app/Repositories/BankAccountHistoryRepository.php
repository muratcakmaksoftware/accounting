<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\BankAccountHistoryRepositoryInterface;
use App\Models\BankAccountHistory;
use Illuminate\Support\Collection;

class BankAccountHistoryRepository extends BaseRepository implements BankAccountHistoryRepositoryInterface
{
    /**
     * @param BankAccountHistory $model
     */
    public function __construct(BankAccountHistory $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $bankAccountId
     * @return Collection
     */
    public function datatables($bankAccountId): Collection
    {
        return $this->model->where('bank_account_id', $bankAccountId)->orderByDesc('id')->get();
    }

    /**
     * @param $bankAccountId
     * @return Collection
     */
    public function trashedDatatables($bankAccountId): Collection
    {
        return $this->model::onlyTrashed()->where('bank_account_id', $bankAccountId)->orderByDesc('id')->get();
    }
}
