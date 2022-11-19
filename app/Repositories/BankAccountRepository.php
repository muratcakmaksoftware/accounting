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
     * @return Collection
     */
    public function datatables(): Collection
    {
        return $this->model::with(['bank' => function ($query) {
            $query->select(['id', 'name']);
        }, 'currencyType' => function ($query) {
            $query->select(['id', 'name', 'code']);
        }])->orderByDesc('id')->get();
    }

    /**
     * @return Collection
     */
    public function trashedDatatables(): Collection
    {
        return $this->model::onlyTrashed()
            ->withWhereHas('bank', function ($query) {
                $query->select(['id', 'name']);
            })
            ->withWhereHas('currencyType', function ($query) {
                $query->select(['id', 'name', 'code']);
            })->orderByDesc('id')->get();
    }
}
