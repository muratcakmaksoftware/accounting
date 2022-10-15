<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;

class CurrencyTypeService extends BaseService
{
    /**
     * @var CurrencyTypeRepositoryInterface
     */
    private CurrencyTypeRepositoryInterface $repository;

    /**
     * @param CurrencyTypeRepositoryInterface $repository
     */
    public function __construct(CurrencyTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
