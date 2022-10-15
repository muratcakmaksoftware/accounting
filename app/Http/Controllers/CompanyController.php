<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
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
