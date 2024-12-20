<?php

namespace Atin\LaravelBlog\Services\BodyGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptBodyGenerator extends BodyGenerator
{
    public function generate(): string
    {
        $siteName = config('app.name');

        $siteDescription = config('laravel-blog.site_description');

        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->chat([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<TEXT
You are a helpful assistant. Your task is to write an interesting and unique article based on the user's inputs. The article should be engaging, informative, and aligned with the purpose of the website it is intended for. Ensure that the article includes relevant keywords, which should be selected based on the website description and its target audience. Additionally, highlight or emphasize important points in the article by **bolding** them. Structure the article clearly with an introduction, body, and conclusion. The article must be written in the language corresponding to the provided language code, `$this->langCode`. The title of the article must also be in the same language.
TEXT
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Write an interesting and unique article based on the following inputs:
- **Post Idea**: $this->postIdea
- **Language Code**: $this->langCode
- **Website Name**: $siteName
- **Website Description**: $siteDescription

Do not generate title! Ensure the article is aligned with the website’s goals, incorporates relevant keywords (based on the website description), and provides value to the target audience. Highlight or **bold** important points throughout the article. Use the website name (“{$siteName}”) explicitly in the article instead of general terms like “our platform” or “our site”.

Include at least three references to the website's homepage distributed evenly throughout the article. Use the following formats for the links: `[try for free now](/$this->langCode)`, `[visit $siteName](/$this->langCode)`, or `[get started now](/$this->langCode)`. Ensure that the link text is translated to the language specified by `$this->langCode` (e.g., for Ukrainian, use "почати зараз", "відвідайте Антипла"). The links should fit naturally into the content and encourage users to engage with $siteName.

Conclude the article with another reference to the homepage: `[$siteName](/$this->langCode)`, ensuring the text is appropriate to the article's context and translated accordingly.
TEXT
                    ],
                ],
                'max_tokens' => 5000,
            ]), false, 512, JSON_THROW_ON_ERROR);

            return $response->choices[0]->message->content;
        } catch (Throwable $exception) {
            var_dump($exception);
            throw new RuntimeException;
        }
    }
}
