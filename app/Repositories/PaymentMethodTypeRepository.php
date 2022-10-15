<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use App\Models\PaymentMethodType;

class PaymentMethodTypeRepository extends BaseRepository implements PaymentMethodTypeRepositoryInterface
{
    public function __construct(PaymentMethodType $model)
    {
        parent::__construct($model);
    }
}
