<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function loginView(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function login(PostLoginRequest $request)
    {
        if (Auth::attempt($request->only([
            'email', 'password'
        ]))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
