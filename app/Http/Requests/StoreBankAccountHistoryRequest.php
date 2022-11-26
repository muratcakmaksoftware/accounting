<?php

namespace App\Http\Requests;

class StoreBankAccountHistoryRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'total' => 'required|numeric',
            'description' => 'string|nullable',
        ];
    }
}
