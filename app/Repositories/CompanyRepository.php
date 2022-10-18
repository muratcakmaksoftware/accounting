<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Support\Collection;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $name
     * @return Collection
     */
    public function getSelect2Ajax(string $name): Collection
    {
        return $this->model->select(['id', 'name as text'])->where('name', 'LIKE', '%'.$name.'%')->get();
    }
}
