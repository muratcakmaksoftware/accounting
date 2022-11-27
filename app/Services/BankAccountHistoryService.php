<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Interfaces\RepositoryInterfaces\BankAccountHistoryRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\BankAccountRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BankAccountHistoryService extends BaseController
{
    /**
     * @var BankAccountHistoryRepositoryInterface
     */
    private BankAccountHistoryRepositoryInterface $repository;

    /**
     * @param BankAccountHistoryRepositoryInterface $repository
     */
    public function __construct(BankAccountHistoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return array
     * @throws BindingResolutionException
     */
    public function index($bankId, $bankAccountId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById($bankId, ['id', 'name']),
            'bankAccount' => app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name'])
        ];
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return array
     * @throws BindingResolutionException
     */
    public function create($bankId, $bankAccountId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]),
            'bankAccount' => app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name']),
        ];
    }

    /**
     * @param array $attributes
     * @param $bankId
     * @param $bankAccountId
     * @return void
     * @throws BindingResolutionException
     */
    public function store(array $attributes, $bankId, $bankAccountId)
    {
        app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]); //Exists bank
        app()->make(BankAccountRepositoryInterface::class)->getById(['id' => $bankAccountId, ['id', 'name']]); //Exists bankAccount
        $attributes['bank_account_id'] = $bankAccountId;
        $this->repository->store($attributes);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @param $id
     * @return array
     * @throws BindingResolutionException
     */
    public function edit($bankId, $bankAccountId, $id): array
    {
        return [
            'bankAccountHistory' => $this->repository->getById($id),
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]),
            'bankAccount' => app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name']),
        ];
    }

    /**
     * @param array $attributes
     * @param $id
     * @return void
     */
    public function update(array $attributes, $id)
    {
        $this->repository->update($attributes, $id);
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $this->repository->destroy($id, ['id', 'bank_account_id', 'total']);
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables($bankId, $bankAccountId): JsonResponse
    {
        $bankAccount = app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name', 'currency_type_id']);
        $currencyCode = $bankAccount->currencyType->code;

        return Datatables::of($this->repository->datatables($bankAccountId))
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->editColumn('total', function ($row) use ($currencyCode) {
                return $row->getPriceFormat($currencyCode, 'total');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) use ($bankId, $bankAccountId) {
                return '<a href="' . route('bank_account_history.edit', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) use ($bankId, $bankAccountId) {
                return '<a onclick="trashed(this)" data-url="' . route('bank_account_history.destroy', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'trashed'])
            ->only(['DT_RowIndex', 'title', 'description', 'total', 'created_at', 'edit', 'trashed'])
            ->toJson();
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return array
     * @throws BindingResolutionException
     */
    public function trashed($bankId, $bankAccountId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]),
            'bankAccount' => app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name']),
        ];
    }

    /**
     * @param $bankId
     * @param $bankAccountId
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function trashedDatatables($bankId, $bankAccountId): JsonResponse
    {
        $bankAccount = app()->make(BankAccountRepositoryInterface::class)->getById($bankAccountId, ['id', 'name', 'currency_type_id']);
        $currencyCode = $bankAccount->currencyType->code;
        return Datatables::of($this->repository->trashedDatatables($bankAccountId))
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->editColumn('total', function ($row) use ($currencyCode) {
                return $row->getPriceFormat($currencyCode, 'total');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) use ($bankId, $bankAccountId) {
                return '<a onclick="restore(this)" data-url="' . route('bank_account_history.restore', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) use ($bankId, $bankAccountId) {
                return '<a onclick="forceDelete(this)" data-url="' . route('bank_account_history.force_delete', ['bankId' => $bankId, 'bankAccountId' => $bankAccountId, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'title', 'description', 'total', 'created_at', 'deleted_at', 'restore', 'force_delete'])
            ->toJson();
    }

    /**
     * @param $id
     * @return void
     */
    public function restore($id)
    {
        $this->repository->restore($id, ['id', 'bank_account_id', 'total']);
    }

    /**
     * @param $id
     * @return void
     */
    public function forceDelete($id)
    {
        $this->repository->forceDelete($id);
    }
}
