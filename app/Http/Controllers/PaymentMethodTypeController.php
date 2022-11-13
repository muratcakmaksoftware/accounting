<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StorePaymentMethodTypeRequest;
use App\Http\Requests\UpdatePaymentMethodTypeRequest;
use App\Services\PaymentMethodTypeService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PaymentMethodTypeController extends BaseController
{
    /**
     * @param PaymentMethodTypeService $service
     * @param FlasherInterface $flasher
     */
    public function __construct(PaymentMethodTypeService $service, FlasherInterface $flasher)
    {
        $this->service = $service;
        $this->flasher = $flasher;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('payment-method-type.index');
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('payment-method-type.create');
    }

    /**
     * @param StorePaymentMethodTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StorePaymentMethodTypeRequest $request): RedirectResponse
    {
        $this->service->store($request->onlyRuleData());
        $this->addFlashSuccess();
        return redirect()->route('payment_method_types.create');
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        return view('payment-method-type.edit', $this->service->edit($id));
    }

    /**
     * @param UpdatePaymentMethodTypeRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdatePaymentMethodTypeRequest $request, $id): RedirectResponse
    {
        $this->service->update($request->onlyRuleData(), $id);
        $this->addFlashSuccess(__('update'));
        return redirect()->route('payment_method_types.edit', ['id' => $id]);
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
        return view('payment-method-type.trashed');
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
