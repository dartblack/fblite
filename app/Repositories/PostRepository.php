<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{

    public function all(): Collection
    {
        return Post::all();
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function find($id)
    {
        return Post::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
    }

    public function where(string $column, string $operator, $value)
    {
        return Post::where($column, $operator, $value)->orderBy('id', 'desc')->get();
    }

    public function search(?string $query = null): Paginator
    {
        $posts = Post::query();
        $posts->with('user');
        if ($query) {
            $posts->where('title', 'like', "%$query%")
                ->orWhere('short_desc', 'like', "%$query%")
                ->orWhereHas('comments', function (Builder $q) use ($query) {
                    $q->where('text', 'like', "%$query%");
                })
                ->orWhereHas('user', function (Builder $q) use ($query) {
                    $q->where('name', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%");
                });
        }


        return $posts->simplePaginate(14);
    }

    public function userPostLikes(int $userId)
    {
        return Post::where('user_id', '=', $userId)->sum('likes');
    }

    public function userPostDisLikes(int $userId)
    {
        return Post::where('user_id', '=', $userId)->sum('disLikes');
    }
}
