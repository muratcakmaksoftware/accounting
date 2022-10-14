<?php

namespace App\Http\Controllers;

use App\Services\PayableService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayableController extends BaseController
{
    /**
     * @var PayableService
     */
    private PayableService $service;

    /**
     * @param PayableService $service
     */
    public function __construct(PayableService $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        return view('payable.index');
    }

    /**
     * @throws Exception
     */
    public function datatables(): JsonResponse
    {
        return $this->service->datatables();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
