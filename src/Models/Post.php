<?php

namespace Atin\LaravelBlog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Laravel\Nova\Actions\Actionable;

class Post extends Model
{
    use Actionable, HasFactory, HasSlug;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'last_view_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query): void
    {
        $query->where('published', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl($this->image, now()->addMinute());
    }

    public function getPreviewAttribute(): string
    {
        return mb_substr(strip_tags(preg_replace('/[#*_`~>\\-]+|^-+$/m', '', $this->body)), 0, 256);
    }

    public function getUrl(): string
    {
        return route('blog.show', [
            'blog' => $this->slug,
        ]);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
