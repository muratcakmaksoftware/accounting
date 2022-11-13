<?php

namespace App\Http\Requests;

class UpdateCurrencyTypeRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'string|nullable',
        ];
    }
}
