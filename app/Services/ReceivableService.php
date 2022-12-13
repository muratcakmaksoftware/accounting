<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\CurrencyTypeRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use App\Interfaces\RepositoryInterfaces\ReceivableRepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ReceivableService extends BaseService
{
    /**
     * @var ReceivableRepositoryInterface
     */
    private ReceivableRepositoryInterface $repository;

    /**
     * @param ReceivableRepositoryInterface $repository
     */
    public function __construct(ReceivableRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     * @throws BindingResolutionException
     */
    public function create(): array
    {
        return [
            'companies' => app()->make(CompanyRepositoryInterface::class)->all(['id', 'name']),
            'currencyTypes' => app()->make(CurrencyTypeRepositoryInterface::class)->all(['id', 'name']),
            'paymentMethodTypes' => app()->make(PaymentMethodTypeRepositoryInterface::class)->all(['id', 'name'])
        ];
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function store(array $attributes)
    {
        $this->repository->store($attributes);
    }

    /**
     * @param $id
     * @return array
     * @throws BindingResolutionException
     */
    public function edit($id): array
    {
        return [
            'receivable' => $this->repository->getById($id),
            'companies' => app()->make(CompanyRepositoryInterface::class)->all(['id', 'name']),
            'currencyTypes' => app()->make(CurrencyTypeRepositoryInterface::class)->all(['id', 'name']),
            'paymentMethodTypes' => app()->make(PaymentMethodTypeRepositoryInterface::class)->all(['id', 'name'])
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
                return 'receivable-id-' . $row->id;
            })
            ->addIndexColumn()
            ->addColumn('company_name', function ($row) {
                return $row->company->name;
            })
            ->editColumn('currency_type', function ($row) {
                return $row->currencyType->name;
            })
            ->editColumn('payment_method_type', function ($row) {
                return $row->paymentMethodType->name;
            })
            ->editColumn('price', function ($row) {
                return $row->getPriceFormat($row->currencyType->code);
            })
            ->editColumn('expires_at', function ($row) {
                return $row->expires_at_format;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) {
                return '<a href="' . route('receivables.edit', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('delete', function ($row) {
                return '<a onclick="deleteReceivable(this)" data-url="' . route('receivables.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->only(['DT_RowIndex', 'company_name', 'currency_type', 'payment_method_type', 'price', 'expires_at',
                'description', 'created_at', 'edit', 'delete'])
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
            ->addColumn('company_name', function ($row) {
                return $row->company->name;
            })
            ->editColumn('currency_type', function ($row) {
                return $row->currencyType->name;
            })
            ->editColumn('payment_method_type', function ($row) {
                return $row->paymentMethodType->name;
            })
            ->editColumn('price', function ($row) {
                return $row->getPriceFormat($row->currencyType->code);
            })
            ->editColumn('expires_at', function ($row) {
                return $row->expires_at_format;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) {
                return '<a onclick="restore(this)" data-url="' . route('receivables.restore', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('receivables.force_delete', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'company_name', 'currency_type', 'payment_method_type', 'price', 'expires_at', 'created_at', 'deleted_at', 'restore', 'force_delete'])
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
