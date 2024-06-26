<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function where(string $column, string $operator, $value);

    public function search(?string $query = null);

    public function userPostLikes(int $userId);

    public function userPostDisLikes(int $userId);
}
