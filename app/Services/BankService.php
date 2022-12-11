<?php

namespace App\Services;

use App\Http\Controllers\BaseController;
use App\Interfaces\RepositoryInterfaces\BankRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BankService extends BaseController
{
    /**
     * @var BankRepositoryInterface
     */
    private BankRepositoryInterface $repository;

    /**
     * @param BankRepositoryInterface $repository
     */
    public function __construct(BankRepositoryInterface $repository)
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
            'bank' => $this->repository->getById($id),
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
            ->editColumn('created_at', function ($row) {
                return $row->created_at_format;
            })
            ->addColumn('bank_accounts', function ($row) {
                return '<a href="' . route('bank_accounts.index', ['bankId' => $row->id]) . '" class="btn btn-primary btn-color-purple"><i class="fa-solid fa-wallet"></i></a>';
            })
            ->addColumn('bank_checks', function ($row) {
                return '<a href="' . route('bank_checks.index', ['bankId' => $row->id]) . '" class="btn btn-info"><i class="fa-solid fa-money-check"></i></a>';
            })
            ->addColumn('edit', function ($row) {
                return '<a href="' . route('banks.edit', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) {
                return '<a onclick="trashed(this)" data-url="' . route('banks.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['bank_accounts', 'bank_checks', 'edit', 'trashed'])
            ->only(['DT_RowIndex', 'name', 'description', 'created_at', 'bank_accounts', 'bank_checks', 'edit', 'trashed'])
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
                return '<a onclick="restore(this)" data-url="' . route('banks.restore', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('banks.force_delete', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'created_at', 'deleted_at', 'restore', 'force_delete'])
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
