<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use App\Models\PaymentMethodType;
use Illuminate\Support\Collection;

class PaymentMethodTypeRepository extends BaseRepository implements PaymentMethodTypeRepositoryInterface
{
    public function __construct(PaymentMethodType $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function datatables(): Collection
    {
        return $this->model::orderByDesc('id')->get();
    }

    /**
     * @return Collection
     */
    public function trashedDatatables(): Collection
    {
        return $this->model::onlyTrashed()->orderByDesc('id')->get();
    }
}
