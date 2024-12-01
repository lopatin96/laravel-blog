<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

abstract class BodyGenerator
{
    public function __construct(
        protected string $postIdea,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
