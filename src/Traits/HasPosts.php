<?php

namespace Atin\LaravelBlog\Traits;

use Atin\LaravelBlog\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPosts
{
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}