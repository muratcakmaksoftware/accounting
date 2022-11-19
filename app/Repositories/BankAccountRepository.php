<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\BankAccountRepositoryInterface;
use App\Models\BankAccount;
use Illuminate\Support\Collection;

class BankAccountRepository extends BaseRepository implements BankAccountRepositoryInterface
{
    /**
     * @param BankAccount $model
     */
    public function __construct(BankAccount $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $bankId
     * @return Collection
     */
    public function datatables($bankId): Collection
    {
        return $this->model::with(['currencyType' => function ($query) {
            $query->select(['id', 'name', 'code']);
        }])->where('bank_id', $bankId)->orderByDesc('id')->get();
    }

    /**
     * @param $bankId
     * @return Collection
     */
    public function trashedDatatables($bankId): Collection
    {
        return $this->model::onlyTrashed()
            ->withWhereHas('currencyType', function ($query) {
                $query->select(['id', 'name', 'code']);
            })->where('bank_id', $bankId)->orderByDesc('id')->get();
    }
}
