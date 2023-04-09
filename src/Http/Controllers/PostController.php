<?php

namespace Atin\LaravelBlog\Http\Controllers;

use Atin\LaravelBlog\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('blogpackage::posts.index', [
            'articles' => Post::getPublished()
                ->paginate(),
        ]);
    }

    public function show(string $slug)
    {
        $article = Post::whereSlug($slug)->firstOrFail();

        return view('blogpackage::posts.show', [
            'article' => $article,
        ]);
    }

    public function image(Post $article)
    {
        return Storage::disk('s3')->response($article->image);
    }
}
