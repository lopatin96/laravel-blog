<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

abstract class BodyGenerator
{
    public function __construct(
        protected string $title,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
