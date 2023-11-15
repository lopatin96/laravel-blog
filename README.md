# Install
### Trait and Casts
Add ```HasPosts``` trait to User model.

## Nova
### Metrics
#### PostsPerDay
```php
<?php

namespace App\Nova\Metrics;

use Atin\LaravelBlog\Models\Post;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class PostsPerDay extends Trend
{
    public $width = '1/4';

    public function calculate(NovaRequest $request): \Laravel\Nova\Metrics\TrendResult
    {
        return $this->countByDays($request, Post::class);
    }

    public function ranges(): array
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            90 => __('90 Days'),
        ];
    }

    public function cacheFor(): \DateInterval|float|\DateTimeInterface|\Illuminate\Support\Carbon|int|null
    {
        return now()->addMinute();
    }
}
```

### Resources
#### Post
```php
<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    public static string $model = \Atin\LaravelBlog\Models\Post::class;

    public static $title = 'id';

    public static $search = [
        'title', 'feature',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()
                ->sortable(),

            BelongsTo::make('User')
                ->displayUsing(fn ($user) => mb_strimwidth($user->name, 0, 32, '…')),

            URL::make('Open', fn () => '/blog/' . $this->slug),

            Text::make('Title')
                ->sortable()
                ->displayUsing(fn () => mb_strimwidth($this->title, 0, 32, '…')),

            Text::make('Slug')
                ->hideFromIndex(),

            Trix::make('Body'),

            Image::make('Image')
                ->disk('s3')
                ->path('posts/' . date('Y/m/d'))
                ->thumbnail(function ($image) {
                    return $image
                        ? Storage::disk('s3')
                            ->temporaryUrl($image, now()->addMinute())
                        : null;
                })
                ->preview(function ($image) {
                    return $image
                        ? Storage::disk('s3')
                            ->temporaryUrl($image, now()->addMinute())
                        : null;
                }),

            Text::make('Feature')
                ->sortable(),

            Text::make('Meta title')
                ->hideFromIndex(),

            Text::make('Meta description')
                ->hideFromIndex(),

            Boolean::make('Published'),

            Number::make('Views')
                ->sortable()
                ->readonly(),

            Stack::make('Last View At', [
                DateTime::make('Last View At'),

                Line::make(null, function () {
                    return $this->last_view_at
                        ? "({$this->last_view_at->diffForHumans()})"
                        : null;
                })
                    ->asSmall(),
            ])
                ->sortable()
                ->readonly(),

            Stack::make('Created At', [
                DateTime::make('Created At'),

                Line::make(null, function () {
                    return "({$this->created_at->diffForHumans()})";
                })
                    ->asSmall(),
            ])
                ->sortable()
                ->readonly(),
        ];
    }

    public function cards(NovaRequest $request): array
    {
        return [
            new Metrics\PostsPerDay,
        ];
    }
}
```

# Publishing
### Migrations
```php
php artisan vendor:publish --tag="laravel-blog-migrations"
```

### Localization
```php
php artisan vendor:publish --tag="laravel-blog-lang"
```

### Views
```php
php artisan vendor:publish --tag="laravel-blog-views"
```

### Config
```php
php artisan vendor:publish --tag="laravel-blog-config"
```