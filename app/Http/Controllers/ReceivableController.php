<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
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
        $this->service->store($request->all());
        $this->addFlashSuccess();
        return redirect()->route('receivables.create');
    }

    /**
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        return view('receivable.show');
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
}
