<?php

namespace App\Http\Requests;

class UpdateBankAccountRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'iban' => 'string|nullable',
            'currency_type_id' => 'required|integer|exists:currency_types,id',
            'balance' => 'required|numeric',
            'description' => 'string|nullable',
        ];
    }
}
