<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StorePayableRequest;
use App\Http\Requests\UpdatePayableRequest;
use App\Services\PayableService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PayableController extends BaseController
{
    /**
     * @param PayableService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(PayableService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('payable.index');
    }

    /**
     * @return Factory|View|Application
     * @throws BindingResolutionException
     */
    public function create(): Factory|View|Application
    {
        return view('payable.create', $this->service->create());
    }

    /**
     * @param StorePayableRequest $request
     * @return RedirectResponse
     */
    public function store(StorePayableRequest $request): RedirectResponse
    {
        $this->service->store($request->onlyRuleData());
        $this->addFlashSuccess();
        return redirect()->route('payables.create');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function edit($id): View|Factory|Application
    {
        return view('payable.edit', $this->service->edit($id));
    }

    /**
     * @param UpdatePayableRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdatePayableRequest $request, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('payables.edit', ['id' => $id]);
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
        return view('payable.trashed');
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
