<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function find($id)
    {
        return Comment::findOrFail($id);
    }


    public function update(array $data, $id)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function userCommentLikes(int $userId)
    {
        return Comment::where('user_id', '=', $userId)->sum('likes');
    }

    public function userCommentDisLikes(int $userId)
    {
        return Comment::where('user_id', '=', $userId)->sum('disLikes');
    }
}
