<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use App\Models\CurrencyType;
use Illuminate\Support\Collection;

class CurrencyTypeRepository extends BaseRepository implements CurrencyTypeRepositoryInterface
{
    public function __construct(CurrencyType $model)
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
