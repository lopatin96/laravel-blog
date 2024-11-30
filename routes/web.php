<?php

use Illuminate\Support\Facades\Route;
use Atin\LaravelBlog\Http\Controllers\PostController;

Route::resource('blog', PostController::class)
    ->only(['index', 'show']);