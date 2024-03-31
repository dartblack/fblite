<?php

namespace App\Providers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostService::class, function ($app) {
            return new PostService($app->make(PostRepositoryInterface::class));
        });

        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentService::class, function ($app) {
            return new CommentService($app->make(CommentRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
