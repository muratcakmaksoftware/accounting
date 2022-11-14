<?php

namespace App\Http\Requests;

class StoreBankRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'string'
        ];
    }
}
