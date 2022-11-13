<?php

namespace App\Http\Requests;

class UpdatePaymentMethodTypeRequest extends BaseRequest
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
