<?php

namespace Atin\LaravelBlog\Services\MetaDescriptionGenerator;

abstract class MetaDescriptionGenerator
{
    public function __construct(
        protected string $postBody,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
