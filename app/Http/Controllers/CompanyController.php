<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\QueryCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CompanyController extends BaseController
{
    /**
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param QueryCompanyRequest $request
     * @return JsonResponse
     */
    public function select2Ajax(QueryCompanyRequest $request): JsonResponse
    {
        return ResponseHelper::success($this->service->getSelect2Ajax($request->get('name')));
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
