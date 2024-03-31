<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->postRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->postRepository->update($data, $id);
    }

    public function delete($id): void
    {
        $this->postRepository->delete($id);
    }

    public function all(): Collection
    {
        return $this->postRepository->all();
    }

    public function find($id)
    {
        return $this->postRepository->find($id);
    }

    public function where(string $column, string $operator, $value)
    {
        return $this->postRepository->where($column, $operator, $value);
    }

    public function search(?string $query = null): Paginator
    {
        return $this->postRepository->search($query);
    }

    public function userPostLikes(int $userId)
    {
        return $this->postRepository->userPostLikes($userId);
    }

    public function userPostDisLikes(int $userId)
    {
        return $this->postRepository->userPostDisLikes($userId);
    }

}
