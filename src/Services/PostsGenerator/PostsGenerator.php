<?php

namespace Atin\LaravelBlog\Services\PostsGenerator;

use Atin\LaravelBlog\Models\Post;
use Atin\LaravelBlog\Services\PostIdeaGenerator\ChatGptPostIdeaGenerator;

abstract class PostsGenerator
{
    public function __construct()
    {
        $posts = Post::latest()
            ->published()
            ->where('geo', 'en')
            ->take(10)
            ->get(['title', 'views'])
            ->toArray();

        $this->postIdea = (new ChatGptPostIdeaGenerator($posts))->generate();
    }

    abstract public function generate(): void;
}
