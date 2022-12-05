<?php

namespace App\Http\Requests;

class StoreBankCheckRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'currency_type_id' => 'required|integer|exists:currency_types,id',
            'total' => 'required|numeric',
            'description' => 'string|nullable',
        ];
    }
}
