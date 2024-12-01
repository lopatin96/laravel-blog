<?php

namespace Atin\LaravelBlog\Services\PostsGenerator;

use Atin\LaravelBlog\Jobs\GeneratePost;
use Orhanerday\OpenAi\OpenAi;

class ChatGptPostsGenerator extends PostsGenerator
{
    public function generate(): void
    {
        foreach (array_keys(config('laravel-blog.content_generation_data')) as $langCode) {
            GeneratePost::dispatch($this->postIdea, $langCode);
        }
    }
}
