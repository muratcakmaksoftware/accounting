<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\BankCheckRepositoryInterface;
use App\Models\BankCheck;
use Illuminate\Support\Collection;

class BankCheckRepository extends BaseRepository implements BankCheckRepositoryInterface
{
    /**
     * @param BankCheck $model
     */
    public function __construct(BankCheck $model)
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
