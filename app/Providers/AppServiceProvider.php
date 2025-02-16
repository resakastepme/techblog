<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('posts')) {
            $popularPost = Post::withCount('likes')->orderBy('likes_count', 'desc')->with('user')->limit(3)->get();
            View::share('popularPost', $popularPost);
        } else {
            View::share('popularPost', collect([]));
        }
    }
}
