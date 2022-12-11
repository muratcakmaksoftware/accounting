<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Interfaces\RepositoryInterfaces\BankAccountRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BankAccountService extends BaseController
{
    /**
     * @var BankAccountRepositoryInterface
     */
    private BankAccountRepositoryInterface $repository;

    /**
     * @param BankAccountRepositoryInterface $repository
     */
    public function __construct(BankAccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $bankId
     * @return array
     * @throws BindingResolutionException
     */
    public function index($bankId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById($bankId, ['id', 'name'])
        ];
    }

    /**
     * @param $bankId
     * @return array
     * @throws BindingResolutionException
     */
    public function create($bankId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]),
            'currencyTypes' => app()->make(CurrencyTypeRepositoryInterface::class)->all(['id', 'name']),
        ];
    }

    /**
     * @param array $attributes
     * @param $bankId
     * @return void
     * @throws BindingResolutionException
     */
    public function store(array $attributes, $bankId)
    {
        app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]); //Exists bank
        $attributes['bank_id'] = $bankId;
        $this->repository->store($attributes);
    }

    /**
     * @param $bankId
     * @param $id
     * @return array
     * @throws BindingResolutionException
     */
    public function edit($bankId, $id): array
    {
        return [
            'bankAccount' => $this->repository->getById($id),
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']]),
            'currencyTypes' => app()->make(CurrencyTypeRepositoryInterface::class)->all(['id', 'name']),
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
        $this->repository->destroy($id);
    }

    /**
     * @param $bankId
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables($bankId): JsonResponse
    {
        return Datatables::of($this->repository->datatables($bankId))
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->addColumn('currency_type_name', function ($row) {
                return $row->currencyType->name;
            })
            ->editColumn('balance', function ($row) {
                return $row->getPriceFormat($row->currencyType->code, 'balance');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('extract', function ($row) {
                return '<a href="' . route('bank_account_history.index', ['bankId' => $row->bank->id, 'bankAccountId' => $row->id]) . '" class="btn btn-primary btn-color-purple"><i class="fa-solid fa-receipt"></i></a>';
            })
            ->addColumn('edit', function ($row) use ($bankId) {
                return '<a href="' . route('bank_accounts.edit', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) use ($bankId) {
                return '<a onclick="trashed(this)" data-url="' . route('bank_accounts.destroy', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['extract', 'edit', 'trashed'])
            ->only(['DT_RowIndex', 'name', 'iban', 'currency_type_name', 'balance', 'created_at', 'extract', 'edit', 'trashed'])
            ->toJson();
    }

    /**
     * @param $bankId
     * @return array
     * @throws BindingResolutionException
     */
    public function trashed($bankId): array
    {
        return [
            'bank' => app()->make(BankRepositoryInterface::class)->getById(['id' => $bankId, ['id', 'name']])
        ];
    }

    /**
     * @param $bankId
     * @return JsonResponse
     * @throws Exception
     */
    public function trashedDatatables($bankId): JsonResponse
    {
        return Datatables::of($this->repository->trashedDatatables($bankId))
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->editColumn('currency_type_name', function ($row) {
                return $row->currencyType->name;
            })
            ->editColumn('balance', function ($row) {
                return $row->getPriceFormat($row->currencyType->code, 'balance');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) use ($bankId) {
                return '<a onclick="restore(this)" data-url="' . route('bank_accounts.restore', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) use ($bankId) {
                return '<a onclick="forceDelete(this)" data-url="' . route('bank_accounts.force_delete', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'currency_type_name', 'balance', 'created_at', 'deleted_at', 'restore', 'force_delete'])
            ->toJson();
    }

    /**
     * @param $id
     * @return void
     */
    public function restore($id)
    {
        $this->repository->restore($id);
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
