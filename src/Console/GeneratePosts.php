<?php

namespace Atin\LaravelBlog\Console;

use Atin\LaravelBlog\Services\PostsGenerator\ChatGptPostsGenerator;

class GeneratePosts
{
    public function __invoke(): void
    {
        (new ChatGptPostsGenerator())->generate();
    }
}
