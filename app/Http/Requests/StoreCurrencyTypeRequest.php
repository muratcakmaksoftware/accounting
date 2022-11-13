<?php

namespace App\Http\Requests;

class StoreCurrencyTypeRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
            'sembol' => 'required|string',
        ];
    }
}
