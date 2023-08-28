<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::resource('blog', Atin\LaravelBlog\Http\Controllers\PostController::class)
        ->only(['index', 'show']);

    Route::get('/blog/{post}/image', [Atin\LaravelBlog\Http\Controllers\PostController::class, 'image']);
});