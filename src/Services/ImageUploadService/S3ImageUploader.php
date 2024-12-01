<?php

namespace Atin\LaravelBlog\Services\ImageUploadService;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class S3ImageUploader extends ImageUploader
{
    public static function uploadFromUrl(string $url): string
    {
        $imageContent = file_get_contents($url);

        if ($imageContent !== false) {
            $filename = 'posts/' . date('Y/m/d/') . Str::uuid() . '.jpg';

            Storage::disk('s3')->put($filename, $imageContent);

            return $filename;
        }

        throw new Exception;
    }
}
