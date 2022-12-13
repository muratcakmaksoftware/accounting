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
            ->addColumn('trashed', function ($row) {
                return '<a onclick="trashed(this)" data-url="' . route('tcmb_currenies.destroy', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['trashed'])
            ->only(['DT_RowIndex', 'name', 'code', 'unit', 'forex_buy', 'forex_sell', 'banknote_buy', 'banknote_sell', 'created_at', 'trashed'])
            ->toJson();
    }
}
