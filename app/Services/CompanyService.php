<?php

namespace App\Services;

use App\Enumerations\StorageFolderPath;
use App\Interfaces\RepositoryInterfaces\CompanyRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Yajra\DataTables\Facades\DataTables;

class CompanyService extends BaseService
{
    /**
     * @var CompanyRepositoryInterface
     */
    private CompanyRepositoryInterface $repository;

    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(CompanyRepositoryInterface $repository)
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
            'company' => $this->repository->getById($id)
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
        DB::transaction(function () use ($id){
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
                return '<a onclick="restore(this)" data-url="' . route('companies.restore', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fa-solid fa-rotate-left"></i></a>';
            })
            ->addColumn('force_delete', function ($row) {
                return '<a onclick="forceDelete(this)" data-url="' . route('companies.force_delete', ['id' => $row->id]) . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['restore', 'force_delete'])
            ->only(['DT_RowIndex', 'name', 'description', 'created_at', 'deleted_at', 'restore', 'force_delete'])
            ->toJson();
    }

    /**
     * @param $id
     * @return void
     */
    public function restore($id)
    {
        DB::transaction(function () use ($id){
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

    /**
     * @param array $attributes
     * @return void
     * @throws Exception
     */
    public function uploadCompanies(array $attributes): void
    {
        $uploadedPath = app()->make(FileUploadService::class)->upload(StorageFolderPath::UPLOAD->value, $attributes['file'], 'excel_', true);
        if ($uploadedPath !== false) {
            $collections = FastExcel::import(Storage::path($uploadedPath));
            foreach ($collections as $row) {
                if (!$this->repository->getModel()->where('name', $row['Hesap Adı'])->exists()) {
                    $this->store([
                        'name' => $row['Hesap Adı']
                    ]);
                }
            }
            Storage::delete($uploadedPath);
        }
    }

    /**
     * @param string $name
     * @return Collection
     */
    public function getSelect2Ajax(string $name): Collection
    {
        return $this->repository->getSelect2Ajax($name);
    }
}
