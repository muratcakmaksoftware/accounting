<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadService extends BaseService
{
    /**
     * @param string $storageFolderPath
     * @param UploadedFile $uploadedFile
     * @param string $uniqPrefix
     * @param bool $throwException
     * @return bool|string
     * @throws Exception
     */
    public function upload(string $storageFolderPath, UploadedFile $uploadedFile, string $uniqPrefix = '', bool $throwException = false): bool|string
    {
        $uniqFileName = uniqid($uniqPrefix) . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedPath = Storage::putFileAs($storageFolderPath, $uploadedFile, $uniqFileName);
        if ($uploadedPath === false) {
            if ($throwException) {
                throw new Exception(__('fileUploadError'));
            }
            return false;
        }
        return $uploadedPath;
    }
}
