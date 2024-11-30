<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptBodyGenerator extends BodyGenerator
{
    public function generate(): string
    {
        $siteDescription = config('laravel-blog.site_description');

        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->chat([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<TEXT
You are a helpful assistant. Your task is to write an interesting and unique article based on the user's inputs. The article should be engaging, informative, and aligned with the purpose of the website it is intended for. Ensure that the article includes relevant keywords, which should be selected based on the website description and its target audience. Additionally, highlight or emphasize important points in the article by **bolding** them. Structure the article clearly with an introduction, body, and conclusion.
TEXT,
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Write an interesting and unique article based on the following inputs:
- **Title**: $this->title
- **Language Code**: $this->langCode
- **Website Description**: $siteDescription

Make sure the article is aligned with the website’s goals, incorporates relevant keywords (based on the website description), and provides value to the target audience. Highlight or **bold** important points throughout the article. Include a reference to the website's homepage at the end of the article using the format: `[Website Name](/[Language Code])`.
TEXT
                    ],
                ],
                'max_tokens' => 4000,
            ]), false, 512, JSON_THROW_ON_ERROR);

            return $response->choices[0]->message->content;
        } catch (Throwable $exception) {
            var_dump($exception);
            throw new RuntimeException;
        }
    }
}
