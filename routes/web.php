<?php

use Illuminate\Support\Facades\Route;

Route::resource('blog', Atin\LaravelBlog\Http\Controllers\PostController::class)
    ->only(['index', 'show']);