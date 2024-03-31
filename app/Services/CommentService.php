<?php

namespace App\Services;


use App\Repositories\CommentRepository;

class CommentService
{
    public function __construct(
        protected CommentRepository $commentRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->commentRepository->create($data);
    }
}
