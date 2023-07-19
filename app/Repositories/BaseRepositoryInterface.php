<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function model();

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function findBy(string $element, mixed $value, array $columns = ['*']);
}
