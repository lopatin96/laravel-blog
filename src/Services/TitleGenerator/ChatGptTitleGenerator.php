<?php

namespace Atin\LaravelBlog\Services\TitleGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptTitleGenerator extends TitleGenerator
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
You are an expert SEO copywriter and content strategist. Your task is to generate a short, compelling, and SEO-friendly title for an post. The title should:

1. Be concise but clearly convey the main idea of the post.
2. Be engaging and appealing to potential readers.
3. Include relevant keywords for SEO purposes, where possible.
4. Avoid excessive complexity or generic phrasing.
5. Write only the title, do not write in quotes, or "Title:".
6. You must provide the answer in the language corresponding to the country code $this->langCode.
TEXT
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Based on the following post text, please create a title that meets these criteria:
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
