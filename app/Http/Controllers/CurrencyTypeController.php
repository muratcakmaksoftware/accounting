<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CurrencyTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyTypeController extends BaseController
{
    /**
     * @param CurrencyTypeService $service
     */
    public function __construct(CurrencyTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {

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
