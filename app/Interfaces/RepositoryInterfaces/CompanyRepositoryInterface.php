<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Support\Collection;

interface CompanyRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function datatables(): Collection;

    /**
     * @return Collection
     */
    public function trashedDatatables(): Collection;

    /**
     * @param string $name
     * @return mixed
     */
    public function getSelect2Ajax(string $name): Collection;
}
