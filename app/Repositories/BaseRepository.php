<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class BaseRepository implements BaseRepositoryInterface
{

    public function __construct(protected Model|Builder $model)
    {
    }

    public function model(): string
    {
        return get_class($this->model);
    }

    public function create(array $data): array
    {
        $query = $this->model instanceof Builder ? $this->model : $this->model->query();
        return $query->create($data)->toArray();
    }

    public function update(int $id, array $data): int
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete(int $id): int
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }

    public function findBy(string $element, mixed $value, array $columns = ['*']): array
    {
        $query = $this->model
            ->where($element, $value);
        if ($element == 'id' || $element == 'username') {
            $result = $query->first($columns);
            return (!empty($result)) ? $result->toArray() : [];
        }
        return $query->get($columns)->toArray();
    }
}
