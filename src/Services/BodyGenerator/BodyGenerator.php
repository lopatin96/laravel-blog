<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

use App\Models\Article;

abstract class BodyGenerator
{
    public function __construct(
        protected string $title,
        protected string $lang,
    )
    {
    }

    abstract public function generate(): string;
}
