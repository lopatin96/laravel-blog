<?php

namespace Atin\LaravelBlog\Services\MetaDescriptionGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptMetaDescriptionGenerator extends MetaDescriptionGenerator
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
You are an expert SEO copywriter and digital strategist. Your task is to generate an SEO-friendly meta description for an post. The meta description should:

1. Be concise and within the character limit for meta descriptions (typically 150–160 characters).
2. Clearly summarize the main idea or value of the post.
3. Be engaging to potential readers, encouraging them to click.
4. Include relevant keywords for SEO optimization, where appropriate.
5. Avoid unnecessary filler words or excessive detail.
6. Write only the title, do not write in quotes, or "Meta Description:".
7. You must provide the answer in the language corresponding to the country code $this->langCode.
TEXT
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Based on the following post text, please create a meta description that meets these criteria:
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
