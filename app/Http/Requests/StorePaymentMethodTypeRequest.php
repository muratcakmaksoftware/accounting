<?php

namespace App\Http\Requests;

class StorePaymentMethodTypeRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
