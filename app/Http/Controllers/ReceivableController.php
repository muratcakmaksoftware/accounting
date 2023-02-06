<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SingleExcelUploadFileRequest;
use App\Http\Requests\StoreReceivableRequest;
use App\Http\Requests\UpdateReceivableRequest;
use App\Services\ReceivableService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReceivableController extends BaseController
{
    /**
     * @param ReceivableService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(ReceivableService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('receivable.index');
    }

    /**
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function create(): Factory|View|Application
    {
        return view('receivable.create', $this->service->create());
    }

    /**
     * @param StoreReceivableRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReceivableRequest $request): RedirectResponse
    {
        $this->service->store($request->onlyRuleData());
        $this->addFlashSuccess();
        return redirect()->route('receivables.create');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function edit($id): View|Factory|Application
    {
        return view('receivable.edit', $this->service->edit($id));
    }

    /**
     * @param UpdateReceivableRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateReceivableRequest $request, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('receivables.edit', ['id' => $id]);
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
        return view('receivable.trashed');
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

    /**
     * @param SingleExcelUploadFileRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function uploadReceivables(SingleExcelUploadFileRequest $request): JsonResponse
    {
        $this->service->uploadReceivables($request->onlyRuleData());
        return ResponseHelper::success();
    }
}
