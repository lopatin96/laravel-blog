<?php

namespace Atin\LaravelBlog\Services\TitleGenerator;

abstract class TitleGenerator
{
    public function __construct(
        protected string $postBody,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
