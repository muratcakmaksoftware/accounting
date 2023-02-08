<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Services\BankService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BankController extends BaseController
{
    /**
     * @param BankService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(BankService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('bank.index');
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('bank.create');
    }

    /**
     * @param StoreBankRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBankRequest $request): RedirectResponse
    {
        $this->service->store($request->onlyRuleData());
        $this->addFlashSuccess();
        return redirect()->route('banks.create');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        return view('bank.edit', $this->service->edit($id));
    }

    /**
     * @param UpdateBankRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateBankRequest $request, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('banks.edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->service->destroy($id);
        return ResponseHelper::destroy();
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables(): JsonResponse
    {
        return $this->service->datatables();
    }

    /**
     * @return Application|Factory|View
     */
    public function trashed(): View|Factory|Application
    {
        return view('bank.trashed');
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function trashedDatatables(): JsonResponse
    {
        return $this->service->trashedDatatables();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function restore($id): JsonResponse
    {
        $this->service->restore($id);
        return ResponseHelper::restore();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function forceDelete($id): JsonResponse
    {
        $this->service->forceDelete($id);
        return ResponseHelper::forceDelete();
    }
}
