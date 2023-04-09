<?php

namespace Atin\BlogPackage;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Resources
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blogpackage');
    }
}