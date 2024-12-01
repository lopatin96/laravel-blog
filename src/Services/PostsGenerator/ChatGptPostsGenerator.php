<?php

namespace Atin\LaravelBlog\Services\PostsGenerator;

use Atin\LaravelBlog\Jobs\GeneratePost;
use Orhanerday\OpenAi\OpenAi;

class ChatGptPostsGenerator extends PostsGenerator
{
    public function generate(): void
    {
        foreach (config('laravel-blog.content_generation_data') as $langCode => $data) {
            if (random_int(0, 100) <= $data['generation_probability']) {
                GeneratePost::dispatch($this->postIdea, $langCode);
            }
        }
    }
}
