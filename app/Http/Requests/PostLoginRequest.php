<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLoginRequest extends FormRequest
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
