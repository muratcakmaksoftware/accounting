<?php

namespace App\Http\Requests;

class StoreReceivableRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'company_id' => 'required|integer',
            'currency_type_id' => 'required|integer',
            'payment_method_type_id' => 'required|integer',
            'price' => 'required|numeric',
            'expires_at' => 'required|date',
            'description' => 'string|nullable',
        ];
    }
}
