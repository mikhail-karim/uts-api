<?php

namespace App\Providers;

use App\Models\Movie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // Gate::define('modify', function ($user, Post $post) {
        //     return $user->id === $post->user_id;
        // });
        Gate::define('modify', function ($user, Movie $movie) {
            return $user->id === $movie->user_id;
        });
    }
}
