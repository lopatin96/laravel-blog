<?php

namespace Atin\LaravelBlog\Services\ImageGenerator;

abstract class ImageGenerator
{
    public function __construct(
        protected string $imageAlt
    )
    {
    }

    abstract public function generate(): string;
}
