<?php

namespace App\Http\Requests;

class UpdateCompanyRequest extends BaseRequest
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
