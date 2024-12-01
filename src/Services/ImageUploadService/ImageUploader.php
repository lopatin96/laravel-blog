<?php

namespace Atin\LaravelBlog\Services\ImageUploadService;

use Exception;

abstract class ImageUploader
{
    /**
     * @throws Exception
     */
    abstract public static function uploadFromUrl(string $url): string;
}
