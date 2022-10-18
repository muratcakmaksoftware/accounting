<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param PostLoginRequest $request
     * @return RedirectResponse
     */
    public function login(PostLoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only([
            'email', 'password'
        ]))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
