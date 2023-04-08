<?php

use Illuminate\Support\Facades\Route;

Route::resource('posts', Atin\BlogPackage\Http\Controllers\PostController::class)
    ->only(['index', 'show']);
Route::get('/posts/{post}/image', [Atin\BlogPackage\Http\Controllers\PostController::class, 'image']);