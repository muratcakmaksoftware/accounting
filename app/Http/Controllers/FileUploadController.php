<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingleExcelUploadFileRequest;
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

    public function update(SingleExcelUploadFileRequest $request)
    {
        $this->service->upload($request->onlyRuleData());
    }
}
