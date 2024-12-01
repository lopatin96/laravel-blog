<?php

namespace Atin\LaravelBlog\Services\PostGenerator;

use Atin\LaravelBlog\Models\Post;
use Atin\LaravelBlog\Services\BodyGenerator\ChatGptBodyGenerator;
use Orhanerday\OpenAi\OpenAi;

class ChatGptPostGenerator extends PostGenerator
{
    public function generate(): void
    {
        $newPostBody = (new ChatGptBodyGenerator($this->postIdea, $this->langCode))->generate();

        Post::create([
            'title' => 'Title',
            'image' => 'Image',
            'user_id' => 1,
            'body' => $newPostBody,
            'geo' => $this->langCode,
            'published' => true,
        ]);
    }
}
