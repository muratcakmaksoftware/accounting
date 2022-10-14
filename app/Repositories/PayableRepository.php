<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\PayableRepositoryInterface;
use App\Models\Payable;
use Illuminate\Database\Eloquent\Collection;

class PayableRepository extends BaseRepository implements PayableRepositoryInterface
{
    /**
     * @param Payable $model
     */
    public function __construct(Payable $model)
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
            $query->select(['id', 'name']);
        }, 'paymentMethodType' => function ($query) {
            $query->select(['id', 'name']);
        }])->orderByDesc('id')->get();
    }
}
