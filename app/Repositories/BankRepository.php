<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;
use App\Models\Bank;
use Illuminate\Support\Collection;

class BankRepository extends BaseRepository implements BankRepositoryInterface
{
    /**
     * @param Bank $model
     */
    public function __construct(Bank $model)
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
