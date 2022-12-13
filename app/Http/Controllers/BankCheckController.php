<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreBankCheckRequest;
use App\Http\Requests\UpdateBankCheckRequest;
use App\Services\BankCheckService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BankCheckController extends BaseController
{
    /**
     * @param BankCheckService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(BankCheckService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @param $bankId
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function index($bankId): Factory|View|Application
    {
        return view('bank-check.index', $this->service->index($bankId));
    }

    /**
     * @param $bankId
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function create($bankId): Factory|View|Application
    {
        return view('bank-check.create', $this->service->create($bankId));
    }

    /**
     * @param StoreBankCheckRequest $request
     * @param $bankId
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(StoreBankCheckRequest $request, $bankId): RedirectResponse
    {
        $this->service->store($request->onlyRuleData(), $bankId);
        $this->addFlashSuccess();
        return redirect()->route('bank_checks.create', ['bankId' => $bankId]);
    }

    /**
     * @param $bankId
     * @param $id
     * @return View|Factory|Application
     * @throws BindingResolutionException
     */
    public function edit($bankId, $id): View|Factory|Application
    {
        return view('bank-check.edit', $this->service->edit($bankId, $id));
    }

    /**
     * @param UpdateBankCheckRequest $request
     * @param $bankId
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateBankCheckRequest $request, $bankId, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('bank_checks.edit', ['bankId' => $bankId, 'id' => $id]);
    }

    /**
     * @param $bankId
     * @param $id
     * @return JsonResponse
     */
    public function destroy($bankId, $id): JsonResponse
    {
        $this->service->destroy($id);
        return ResponseHelper::destroy();
    }

    /**
     * @param $bankId
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables($bankId): JsonResponse
    {
        return $this->service->datatables($bankId);
    }

    /**
     * @param $bankId
     * @return View|Factory|Application
     * @throws BindingResolutionException
     */
    public function trashed($bankId): View|Factory|Application
    {
        return view('bank-check.trashed', $this->service->trashed($bankId));
    }

    /**
     * @param $bankId
     * @return JsonResponse
     * @throws Exception
     */
    public function trashedDatatables($bankId): JsonResponse
    {
        return $this->service->trashedDatatables($bankId);
    }

    /**
     * @param $bankId
     * @param $id
     * @return JsonResponse
     */
    public function restore($bankId, $id): JsonResponse
    {
        $this->service->restore($id);
        return ResponseHelper::restore();
    }

    /**
     * @param $bankId
     * @param $id
     * @return JsonResponse
     */
    public function forceDelete($bankId, $id): JsonResponse
    {
        $this->service->forceDelete($id);
        return ResponseHelper::forceDelete();
    }
}
