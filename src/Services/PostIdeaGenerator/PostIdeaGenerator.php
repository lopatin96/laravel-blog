<?php

namespace Atin\LaravelBlog\Services\PostIdeaGenerator;

abstract class PostIdeaGenerator
{
    public function __construct(
        protected array $posts,
    )
    {
    }

    abstract public function generate(): string;
}
