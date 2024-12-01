<?php

namespace Atin\LaravelBlog\Services\ImageAltGenerator;

abstract class ImageAltGenerator
{
    public function __construct(
        protected string $postBody,
        protected string $langCode,
    )
    {
    }

    abstract public function generate(): string;
}
