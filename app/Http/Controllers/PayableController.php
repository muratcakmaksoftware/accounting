<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayableRequest;
use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use App\Services\PayableService;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $companies = app()->make(CompanyRepositoryInterface::class)->all(['id', 'name']);
        $currencyTypes = app()->make(CurrencyTypeRepositoryInterface::class)->all(['id', 'name']);
        $paymentMethodTypes = app()->make(PaymentMethodTypeRepositoryInterface::class)->all(['id', 'name']);

        return view('payable.create', [
            'companies' => $companies,
            'currencyTypes' => $currencyTypes,
            'paymentMethodTypes' => $paymentMethodTypes
        ]);
    }

    /**
     * @param StorePayableRequest $request
     * @return RedirectResponse
     */
    public function store(StorePayableRequest $request): RedirectResponse
    {
        $this->service->store($request->all());
        $this->flasher->addSuccess('Başarıyla Kaydedildi');
        return redirect()->route('payables.create');
    }

    /**
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        return view('payable.show');
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

    /**
     * @throws Exception
     */
    public function datatables(): JsonResponse
    {
        return $this->service->datatables();
    }
}
