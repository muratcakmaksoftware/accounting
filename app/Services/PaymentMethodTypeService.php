<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\PaymentMethodTypeRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentMethodTypeService extends BaseService
{
    /**
     * @var PaymentMethodTypeRepositoryInterface
     */
    private PaymentMethodTypeRepositoryInterface $repository;

    /**
     * @param PaymentMethodTypeRepositoryInterface $repository
     */
    public function __construct(PaymentMethodTypeRepositoryInterface $repository)
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
     * @param $id
     * @return array
     */
    public function edit($id): array
    {
        return [
            'paymentMethodType' => $this->repository->getById($id)
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
        DB::transaction(function () use ($id) {
            $this->repository->destroy($id);
        });
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
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('edit', function ($row) {
                return '<a href="' . route('payment_method_types.edit', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) {
                return '<a onclick="trashed(this)" data-url="' . route('payment_method_types.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'trashed'])
            ->only(['DT_RowIndex', 'name', 'code', 'sembol', 'created_at', 'edit', 'trashed'])
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
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at_format;
            })
            ->addColumn('restore', function ($row) {
                return '<a onclick="restore(this)" data-url="' . route('payment_method_types.restore', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('payment_method_types.force_delete', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'code', 'sembol', 'created_at', 'deleted_at', 'restore', 'force_delete'])
            ->toJson();
    }

    /**
     * @param $id
     * @return void
     */
    public function restore($id)
    {
        DB::transaction(function () use ($id) {
            $this->repository->restore($id);
        });
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
