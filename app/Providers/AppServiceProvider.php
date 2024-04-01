<?php

namespace App\Providers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\RankRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\RankRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(RankRepositoryInterface::class, RankRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
