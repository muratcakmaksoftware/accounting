<?php

namespace App\Http\Requests;

class SingleExcelUploadFileRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:xlsx,csv,xls|max:' . config('filesystems.max_size'),
        ];
    }
}
