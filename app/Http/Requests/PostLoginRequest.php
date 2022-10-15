<?php

namespace App\Http\Requests;

class PostLoginRequest extends BaseRequest
{

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:5'
        ];
    }
}
