<?php

namespace App\Services;

use App\Http\Requests\QueryCompanyRequest;
use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use Illuminate\Support\Collection;

class CompanyService extends BaseService
{
    /**
     * @var CompanyRepositoryInterface
     */
    private CompanyRepositoryInterface $repository;

    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $name
     * @return Collection
     */
    public function getSelect2Ajax(string $name): Collection
    {
        return $this->repository->getSelect2Ajax($name);
    }
}
