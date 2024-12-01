<?php

namespace Atin\LaravelBlog\Jobs;

use Atin\LaravelBlog\Services\PostGenerator\ChatGptPostGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 90;

    public function __construct(
        protected string $postIdea,
        protected string $langCode,
    )
    {
    }

    public function handle(): void
    {
        (new ChatGptPostGenerator($this->postIdea, $this->langCode))->generate();
    }
}
