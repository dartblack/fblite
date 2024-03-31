<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
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
        if ($query) {
            $posts->where('title', 'like', "%$query%")
                ->orWhere('short_desc', 'like', "%$query%");
        }
        $posts->with('user');

        return $posts->simplePaginate(14);
    }
}
