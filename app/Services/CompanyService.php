<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;

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
}
