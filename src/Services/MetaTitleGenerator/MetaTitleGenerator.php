<?php

namespace Atin\LaravelBlog\Services\MetaTitleGenerator;

abstract class MetaTitleGenerator
{
    public function __construct(
        protected string $postBody,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
