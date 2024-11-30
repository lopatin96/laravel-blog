<?php

namespace Atin\LaravelBlog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $title,
        protected string $lang,
    )
    {
    }

    public function handle(): void
    {
        $this->article->update(['category' => ArticleCategory::tryFrom((new ChatGptCategoryGenerator($this->article))->generate())]);
    }
}
