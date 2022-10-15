<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use App\Models\CurrencyType;

class CurrencyTypeRepository extends BaseRepository implements CurrencyTypeRepositoryInterface
{
    public function __construct(CurrencyType $model)
    {
        parent::__construct($model);
    }
}
