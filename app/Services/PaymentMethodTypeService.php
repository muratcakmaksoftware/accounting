<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;

class PaymentMethodTypeService extends BaseService
{
    /**
     * @var PaymentMethodTypeRepositoryInterface
     */
    private PaymentMethodTypeRepositoryInterface $repository;

    /**
     * @param PaymentMethodTypeRepositoryInterface $repository
     */
    public function __construct(PaymentMethodTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
