<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreBankAccountHistoryRequest;
use App\Http\Requests\UpdateBankAccountHistoryRequest;
use App\Services\BankAccountHistoryService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BankAccountHistoryController extends BaseController
{
    /**
     * @param BankAccountHistoryService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(BankAccountHistoryService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function index($bankId, $bankAccountId): Factory|View|Application
    {
        return view('bank-account-history.index', $this->service->index($bankId, $bankAccountId));
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function create($bankId, $bankAccountId): Factory|View|Application
    {
        return view('bank-account-history.create', $this->service->create($bankId, $bankAccountId));
    }

    /**
     * @param StoreBankAccountHistoryRequest $request
     * @param $bankId
     * @param $bankAccountId
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(StoreBankAccountHistoryRequest $request, $bankId, $bankAccountId): RedirectResponse
    {
        $this->service->store($request->onlyRuleData(), $bankId, $bankAccountId);
        $this->addFlashSuccess();
        return redirect()->route('bank_account_history.create', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId]);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return View|Factory|Application
     * @throws BindingResolutionException
     */
    public function edit($bankId, $bankAccountId, $id): View|Factory|Application
    {
        return view('bank-account-history.edit', $this->service->edit($bankId, $bankAccountId, $id));
    }

    /**
     * @param UpdateBankAccountHistoryRequest $request
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateBankAccountHistoryRequest $request, $bankId, $bankAccountId, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('bank_account_history.edit', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId, 'id' => $id]);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return JsonResponse
     */
    public function destroy($bankId, $bankAccountId, $id): JsonResponse
    {
        $this->service->destroy($id);
        return ResponseHelper::destroy();
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables($bankId, $bankAccountId): JsonResponse
    {
        return $this->service->datatables($bankId, $bankAccountId);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return View|Factory|Application
     * @throws BindingResolutionException
     */
    public function trashed($bankId, $bankAccountId): View|Factory|Application
    {
        return view('bank-account-history.trashed', $this->service->trashed($bankId, $bankAccountId));
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return JsonResponse
     * @throws Exception
     */
    public function trashedDatatables($bankId, $bankAccountId): JsonResponse
    {
        return $this->service->trashedDatatables($bankId, $bankAccountId);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return JsonResponse
     */
    public function restore($bankId, $bankAccountId, $id): JsonResponse
    {
        $this->service->restore($id);
        return ResponseHelper::restore();
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return JsonResponse
     */
    public function forceDelete($bankId, $bankAccountId, $id): JsonResponse
    {
        $this->service->forceDelete($id);
        return ResponseHelper::forceDelete();
    }
}
