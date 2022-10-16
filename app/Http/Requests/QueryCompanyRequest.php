<?php

namespace App\Http\Requests;

class QueryCompanyRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
