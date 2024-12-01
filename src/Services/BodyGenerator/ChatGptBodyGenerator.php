<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptBodyGenerator extends BodyGenerator
{
    public function generate(): string
    {
        $siteName = env('app.name');
        $siteDescription = config('laravel-blog.site_description');

        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->chat([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<TEXT
You are a helpful assistant. Your task is to write an interesting and unique article based on the user's inputs. The article should be engaging, informative, and aligned with the purpose of the website it is intended for. Ensure that the article includes relevant keywords, which should be selected based on the website description and its target audience. Additionally, highlight or emphasize important points in the article by **bolding** them. Structure the article clearly with an introduction, body, and conclusion. The article must be written in the language corresponding to the provided language code, `$this->langCode`. The title of the article must also be in the same language.
TEXT,
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Write an interesting and unique article based on the following inputs:
- **Post Idea**: $this->postIdea
- **Language Code**: $this->langCode
- **Website Name**: $siteName
- **Website Description**: $siteDescription

Ensure the article is aligned with the website’s goals, incorporates relevant keywords (based on the website description), and provides value to the target audience. Highlight or **bold** important points throughout the article. Include at least two or three references to the website's homepage in the format: `[попробуй безкоштовно зараз](/$this->langCode)`, `[відвідайте нашу платформу](/$this->langCode)`, or `[почати зараз](/$this->langCode)`. These links should fit naturally into the content and encourage users to engage with the website.

Conclude the article by referencing the homepage again: `[${siteName}](/$this->langCode)`, ensuring the text is appropriate to the article's context.

Also, make sure the title of the article is in the language specified by `$this->langCode` and corresponds with the content.
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
