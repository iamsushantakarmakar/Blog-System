<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check() && auth()->user()->isAdmin()) {
                $view->with('stats', [
                    'total_posts' => Post::count(),
                    'total_users' => User::count(),
                    'total_comments' => Comment::count(),
                ]);
            }
        });
    }
}
