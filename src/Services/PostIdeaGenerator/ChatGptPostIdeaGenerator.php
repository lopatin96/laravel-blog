<?php

namespace Atin\LaravelBlog\Services\PostIdeaGenerator;

use Orhanerday\OpenAi\OpenAi;
use RuntimeException;
use Throwable;

class ChatGptPostIdeaGenerator extends PostIdeaGenerator
{
    public function generate(): string
    {
        $listOfPostsWithViews = implode("\n", array_map(static function ($post, $index) {
            return ($index + 1) . '. "' . $post['title'] . '" (' . $post['views'] . ' views)';
        }, $this->posts, array_keys($this->posts)));

        $siteDescription = config('laravel-blog.site_description');

        try {
            $response = json_decode((new OpenAi(env('OPENAI_API_KEY')))->chat([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => <<<TEXT
You are a content strategy assistant tasked with creating a concise description for the next blog post on a website.

Website description: $siteDescription

You are given a list of past blog topics with their respective view counts in parentheses. Analyze the view counts to identify the audience's preferences and suggest a unique, engaging topic for the next blog post. Your response should focus on one specific topic while introducing fresh ideas related to the website's purpose.  
TEXT,
                    ],
                    [
                        'role' => 'user',
                        'content' => <<<TEXT
Here is a list of previous blog topics and their view counts:  
$listOfPostsWithViews

Based on the most popular themes, create a concise description for the next blog post. Ensure the topic is engaging, relevant, and distinct.
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
