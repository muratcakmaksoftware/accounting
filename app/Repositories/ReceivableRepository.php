<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\ReceivableRepositoryInterface;
use App\Models\Receivable;
use Illuminate\Database\Eloquent\Collection;

class ReceivableRepository extends BaseRepository implements ReceivableRepositoryInterface
{
    /**
     * @param Receivable $model
     */
    public function __construct(Receivable $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function datatables(): Collection
    {
        return $this->model::with(['company' => function ($query) {
            $query->select(['id', 'name']);
        }, 'currencyType' => function ($query) {
            $query->select(['id', 'name', 'code']);
        }, 'paymentMethodType' => function ($query) {
            $query->select(['id', 'name']);
        }])->orderByDesc('id')->get();
    }
}
