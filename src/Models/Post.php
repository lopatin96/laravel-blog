<?php

namespace Atin\LaravelBlog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'feature',
        'published',
        'views',
        'last_view_at',
    ];

    protected $casts = [
        'last_view_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPreviewAttribute(): string
    {
        return mb_substr(strip_tags($this->body), 0, 256);
    }

    public static function getPublished()
    {
        return Post::orderBy('id', 'desc')
            ->where('published', true);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
