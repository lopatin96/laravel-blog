<?php

namespace Atin\LaravelBlog\Services\PostGenerator;

use Atin\LaravelBlog\Enums\WritingSystem;
use Atin\LaravelBlog\Helpers\LanguageHelper;
use Atin\LaravelBlog\Models\Post;
use Atin\LaravelBlog\Services\BodyGenerator\ChatGptBodyGenerator;
use Atin\LaravelBlog\Services\ImageAltGenerator\ChatGptImageAltGenerator;
use Atin\LaravelBlog\Services\ImageGenerator\ChatGptImageGenerator;
use Atin\LaravelBlog\Services\ImageUploadService\S3ImageUploader;
use Atin\LaravelBlog\Services\MetaDescriptionGenerator\ChatGptMetaDescriptionGenerator;
use Atin\LaravelBlog\Services\MetaTitleGenerator\ChatGptMetaTitleGenerator;
use Atin\LaravelBlog\Services\TitleGenerator\ChatGptTitleGenerator;
use Orhanerday\OpenAi\OpenAi;

class ChatGptPostGenerator extends PostGenerator
{
    public function generate(): void
    {
        $newPostBody = (new ChatGptBodyGenerator($this->postIdea, $this->langCode))->generate();
        $imageAlt = (new ChatGptImageAltGenerator($newPostBody, $this->langCode))->generate();

        $post = Post::create([
            'title' => (new ChatGptTitleGenerator($newPostBody, $this->langCode))->generate(),
            'image' => S3ImageUploader::uploadFromUrl((new ChatGptImageGenerator($imageAlt))->generate()),
            'image_alt' => $imageAlt,
            'user_id' => 1,
            'body' => $newPostBody,
            'geo' => $this->langCode,
            'meta_title' => (new ChatGptMetaTitleGenerator($newPostBody, $this->langCode))->generate(),
            'meta_description' => (new ChatGptMetaDescriptionGenerator($newPostBody, $this->langCode))->generate(),
            'published' => true,
        ]);

        if (LanguageHelper::detectWritingSystem($newPostBody) === WritingSystem::Logographic) {
            $post->update([
                'slug' => mb_substr(strip_tags(preg_replace('/[#*_`~>\\-]+|^-+$/m', '', $post->body)), 0, 64),
            ]);
        }
    }
}
