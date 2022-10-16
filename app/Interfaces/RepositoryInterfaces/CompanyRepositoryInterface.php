<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface CompanyRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getSelect2Ajax(string $name): Collection;
}
