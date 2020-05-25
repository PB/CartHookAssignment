<?php

namespace App\Providers;

use App\Services\Comment\CommentService;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Comment\Repository\CommentRepository;
use App\Services\Comment\Repository\CommentRepositoryInterface;
use App\Services\Comment\Repository\JsonPlaceHolderRepository;
use App\Services\Post\Repository\PostRepository;
use App\Services\Post\Repository\PostRepositoryInterface;
use App\Services\User\Repository\UserRepository;
use App\Services\User\Repository\UserRepositoryInterface;
use App\Services\Post\PostService;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Services\Post\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
