<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    /**
     * @param array $attributes
     * @return bool
     */
    public function login(array $attributes): bool
    {
        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }
}
