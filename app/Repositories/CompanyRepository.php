<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
