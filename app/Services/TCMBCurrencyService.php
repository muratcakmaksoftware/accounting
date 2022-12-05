<?php

namespace App\Services;

use App\Interfaces\RepositoryInterfaces\TCMBCurrencyRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TCMBCurrencyService extends BaseService
{
    /**
     * @var TCMBCurrencyRepositoryInterface
     */
    private TCMBCurrencyRepositoryInterface $repository;

    /**
     * @param TCMBCurrencyRepositoryInterface $repository
     */
    public function __construct(TCMBCurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
                return '<a href="' . route('companies.edit', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
            })
            ->addColumn('trashed', function ($row) {
                return '<a onclick="trashed(this)" data-url="' . route('companies.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['edit', 'trashed'])
            ->only(['DT_RowIndex', 'name', 'description', 'created_at', 'edit', 'trashed'])
            ->toJson();
    }
}
