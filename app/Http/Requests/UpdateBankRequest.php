<?php

namespace App\Http\Requests;

class UpdateBankRequest extends BaseRequest
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
