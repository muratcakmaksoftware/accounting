<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\BankCheckRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BankCheckService extends BaseService
{
    /**
     * @var BankCheckRepositoryInterface
     */
    private BankCheckRepositoryInterface $repository;

    /**
     * @param BankCheckRepositoryInterface $repository
     */
    public function __construct(BankCheckRepositoryInterface $repository)
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
            'bankCheck' => $this->repository->getById($id),
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
            ->editColumn('total', function ($row) {
                return $row->getPriceFormat($row->currencyType->code, 'total');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) use ($bankId) {
                return '<a href="' . route('bank_checks.edit', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) use ($bankId) {
                return '<a onclick="trashed(this)" data-url="' . route('bank_checks.destroy', ['bankId' => $bankId, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'trashed'])
            ->only(['DT_RowIndex', 'name', 'iban', 'currency_type_name', 'total', 'description', 'created_at', 'edit', 'trashed'])
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
            ->editColumn('total', function ($row) {
                return $row->getPriceFormat($row->currencyType->code, 'total');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) {
                return '<a onclick="restore(this)" data-url="' . route('bank_checks.restore', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('bank_checks.force_delete', ['bankId' => $row->bank->id, 'id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'currency_type_name', 'total', 'created_at', 'deleted_at', 'restore', 'force_delete'])
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
