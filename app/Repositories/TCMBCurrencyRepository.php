<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\TCMBCurrencyRepositoryInterface;
use App\Models\TCMBCurrency;
use Illuminate\Support\Collection;

class TCMBCurrencyRepository extends BaseRepository implements TCMBCurrencyRepositoryInterface
{
    public function __construct(TCMBCurrency $model)
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
}
