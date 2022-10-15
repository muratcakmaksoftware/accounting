<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Interfaces\RepositoryInterfaces\PayableRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PayableService extends BaseController
{
    /**
     * @var PayableRepositoryInterface
     */
    private PayableRepositoryInterface $repository;

    /**
     * @param PayableRepositoryInterface $repository
     */
    public function __construct(PayableRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
     * @return JsonResponse
     * @throws Exception
     */
    public function datatables(): JsonResponse
    {
        return Datatables::of($this->repository->datatables())
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
                return $row->price_format_try;
            })
            ->editColumn('expires_at', function ($row) {
                return $row->expires_at_format;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) {
                return '<a href="' . route('payables.edit', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>';
            })
            ->addColumn('delete', function ($row) {
                return '<a href="' . route('payables.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            })
            ->rawColumns(['edit', 'delete'])
            ->only(['DT_RowIndex', 'company_name', 'currency_type', 'payment_method_type', 'price', 'expires_at',
                'description', 'created_at', 'edit', 'delete'])
            ->toJson();
    }
}
