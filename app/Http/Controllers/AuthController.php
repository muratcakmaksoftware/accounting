<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use App\Services\AuthService;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends BaseController
{
    /**
     * @param AuthService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(AuthService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

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
        if ($this->service->login($request->onlyRuleData())) {
            return redirect()->route('home');
        }
        $this->addFlashError(__('authenticatedError'));
        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->service->logout();
        return redirect()->route('login');
    }
}
