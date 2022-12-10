<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;

class FileUploadService extends BaseController
{
    /**
     * @var BankRepositoryInterface
     */
    private BankRepositoryInterface $repository;

    /**
     * @param BankRepositoryInterface $repository
     */
    public function __construct(BankRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function upload()
    {

    }
}
