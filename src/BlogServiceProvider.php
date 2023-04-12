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

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('/migrations')
        ], 'laravel-blog-migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/views')
        ], 'laravel-blog-views');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/blog'),
        ], 'laravel-blog-lang');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('blog.php')
        ], 'laravel-blog-config');
    }
}