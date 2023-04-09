<?php

namespace Atin\LaravelBlog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-blog');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-blog');
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-blog');
    }
}