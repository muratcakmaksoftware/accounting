<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Builder|Model|SoftDeletes
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return bool
     */
    public function update(array $attributes, $id): bool
    {
        return $this->getById($id, ['id'])->update($attributes);
    }

    /**
     * @param $id
     * @param array $columns
     * @return bool
     */
    public function destroy($id, array $columns = ['id']): bool
    {
        return $this->getById($id, $columns)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return bool|null
     */
    public function restore($id, array $columns = ['id']): ?bool
    {
        return $this->getById($id, $columns, true)->restore();
    }

    /**
     * @param $id
     * @param array $columns
     * @param bool $onlyTrashed
     * @return Model
     */
    public function getById($id, array $columns = ['*'], bool $onlyTrashed = false): Model
    {
        $this->model = $onlyTrashed ? $this->model->onlyTrashed() : $this->model;
        return $this->model->select($columns)->where('id', $id)->firstOrFail();
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes): bool
    {
        return $this->model->insert($attributes);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function forceDelete($id): ?bool
    {
        return $this->getById($id, ['id'], true)->forceDelete();
    }
}
