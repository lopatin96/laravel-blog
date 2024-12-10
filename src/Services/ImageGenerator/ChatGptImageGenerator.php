<?php

namespace Atin\LaravelBlog\Services\ImageGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptImageGenerator extends ImageGenerator
{

    public function generate(): string
    {
        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->image([
                'prompt' => <<<TEXT
Highly detailed photorealistic, with natural lighting, and a neutral blurred background.
$this->imageAlt,
TEXT,
                'model' => 'dall-e-3', // (‘standard’ or ‘hd’
                'quality' => 'standard', // (‘standard’ or ‘hd’
                'style' => 'vivid', // (‘natural’ or ‘vivid’
                'n' => 1,
                'size' => '1024x1024',
                'response_format' => 'url',
            ]), false, 512, JSON_THROW_ON_ERROR);
            return $response->data[0]->url;
        } catch (Throwable) {
            throw new RuntimeException;
        }
    }
}
