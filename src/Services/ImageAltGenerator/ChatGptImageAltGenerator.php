<?php

namespace Atin\LaravelBlog\Services\ImageAltGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptImageAltGenerator extends ImageAltGenerator
{

    public function generate(): string
    {
        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->chat([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<TEXT
You are an advanced AI assistant specializing in creating detailed and visually engaging image descriptions based on provided post content. Your primary task is to analyze the text and craft a concise, vivid, and realistic description of an image that aligns with the main theme of the post. The description should:

1. Be clear, specific, and easy to interpret.
2. Include relevant details, colors, and objects to ensure accurate visualization.
3. Be written in the language specified by $this->langCode.
4. Avoid generic phrases and focus on creating a distinct and creative prompt that is ideal for image generation tools.

TEXT
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Write a realistic and vivid description of an image that accurately reflects the main idea of the post.
The description must be in the language defined by $this->langCode and shorter then 500 characters.
It should be detailed enough to help generate an engaging and thematically appropriate image.
Avoid including any text elements within the image.
Here is the content of the post:
$this->postBody
TEXT
                    ],
                ],
            ]), false, 512, JSON_THROW_ON_ERROR);

            return $response->choices[0]->message->content;
        } catch (Throwable) {
            throw new RuntimeException;
        }
    }
}
