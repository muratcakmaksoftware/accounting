<?php

namespace App\Interfaces\RepositoryInterfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @return Model|SoftDeletes|Builder
     */
    public function getModel(): Model|SoftDeletes|Builder;

    /**
     * @param array $attributes
     * @return Model
     */
    public function store(array $attributes): Model;

    /**
     * @param array $attributes
     * @param $id
     * @return bool
     */
    public function update(array $attributes, $id): bool;

    /**
     * @param $id
     * @param array $columns
     * @return bool
     */
    public function destroy($id, array $columns = ['id']): bool;

    /**
     * @param $id
     * @param array $columns
     * @return bool|null
     */
    public function restore($id, array $columns = ['id']): ?bool;

    /**
     * @param $id
     * @param array $columns
     * @return Model
     */
    public function getById($id, array $columns = ['*']): Model;

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * @param $id
     * @return bool|null
     */
    public function forceDelete($id): ?bool;

    /**
     * @param array $columns
     * @param string $latestColumn
     * @return Model|Builder|null
     */
    public function latestFirst(array $columns = ['*'], string $latestColumn = 'id'): Model|Builder|null;
}
