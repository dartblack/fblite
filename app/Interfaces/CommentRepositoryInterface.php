<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function update(array $data, $id);
}
