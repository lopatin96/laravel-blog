<?php

namespace Atin\LaravelBlog\Http\Controllers;

use Atin\LaravelBlog\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): View
    {
        return view('laravel-blog::posts.index', [
            'posts' => Post::latest()
                ->published()
                ->paginate(),
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::whereSlug($slug)
            ->firstOrFail();

        if (! (new CrawlerDetect)->isCrawler()) {
            $post->timestamps = false;
            $post->increment('views', 1, ['last_view_at' => now()]);
            $post->timestamps = true;
        }

        return view('laravel-blog::posts.show', [
            'post' => $post,
        ]);
    }

    public function image(string $slug)
    {
        $post = Post::whereSlug($slug)
            ->firstOrFail();

        return Storage::disk('s3')
            ->response($post->image);
    }
}
