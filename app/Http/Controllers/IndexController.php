<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function __construct(
        protected PostService $postService
    )
    {
    }

    public function index(): Response
    {
        $posts = $this->postService->search();
        return Inertia::render('Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts,
        ]);
    }
}
