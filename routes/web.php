<?php

use Illuminate\Support\Facades\Route;

Route::resource('posts', Atin\LaravelBlog\Http\Controllers\PostController::class)
    ->only(['index', 'show']);
Route::get('/posts/{post}/image', [Atin\LaravelBlog\Http\Controllers\PostController::class, 'image']);