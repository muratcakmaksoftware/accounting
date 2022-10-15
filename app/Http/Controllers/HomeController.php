<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends BaseController
{
    /**
     * @param HomeService $service
     */
    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('home');
    }
}
