<?php

namespace App\Services;


use App\Interfaces\CommentRepositoryInterface;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $commentRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->commentRepository->create($data);
    }

    public function find($id)
    {
        return $this->commentRepository->find($id);
    }

    public function update(array $data, $id)
    {
        return $this->commentRepository->update($data, $id);
    }

    public function userCommentLikes(int $userId)
    {
        return $this->commentRepository->userCommentLikes($userId);
    }

    public function userCommentDisLikes(int $userId)
    {
        return $this->commentRepository->userCommentDisLikes($userId);
    }
}
