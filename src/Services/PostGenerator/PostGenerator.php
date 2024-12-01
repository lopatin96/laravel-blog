<?php

namespace Atin\LaravelBlog\Services\PostGenerator;

abstract class PostGenerator
{
    public function __construct(
        protected string $postIdea,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): void;
}
