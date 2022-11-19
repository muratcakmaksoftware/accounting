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
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables(): JsonResponse
    {
        return Datatables::of($this->repository->datatables())
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->editColumn('bank_name', function ($row) {
                return $row->bank->name;
            })
            ->editColumn('currency_type_name', function ($row) {
                return $row->currency_type->name;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) {
                return '<a href="' . route('bank_accounts.edit', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->addColumn('trashed', function ($row) {
                return '<a onclick="trashed(this)" data-url="' . route('bank_accounts.destroy', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->rawColumns(['edit', 'trashed'])
            ->only(['DT_RowIndex', 'bank_name', 'name', 'balance', 'currency_type_name', 'created_at', 'edit', 'trashed'])
            ->toJson();
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function trashedDatatables(): JsonResponse
    {
        return Datatables::of($this->repository->trashedDatatables())
            ->setRowId(function ($row) {
                return 'row-id-' . $row->id;
            })
            ->addIndexColumn()
            ->editColumn('bank_name', function ($row) {
                return $row->bank->name;
            })
            ->editColumn('currency_type_name', function ($row) {
                return $row->currency_type->name;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) {
                return '<a onclick="restore(this)" data-url="' . route('bank_accounts.restore', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa fa fa-undo"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('bank_accounts.force_delete', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'bank_name', 'name', 'balance', 'currency_type_name', 'created_at', 'deleted_at', 'restore', 'force_delete'])
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
