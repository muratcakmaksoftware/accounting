<?php

namespace App\Http\Controllers;

use App\Services\FileUploadService;
use Flasher\Prime\FlasherInterface;

class FileUploadController extends BaseController
{
    /**
     * @param FileUploadService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(FileUploadService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * Global dosya yuklemesi icin yazilmasi gerekirse yazilacak
     */
    /*public function update()
    {
    }*/
}
