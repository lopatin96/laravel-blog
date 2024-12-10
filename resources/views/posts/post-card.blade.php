@props(['post', 'compact' => false])

<div class="p-4 h-full bg-gray-800 bg-opacity-70 rounded-xl">
    <div class="flex flex-col justify-between h-full">
        <a
            class="group text-lg font-medium text-red-500"
            href="{{ $post->getUrl() }}"
        >
            <div class="relative z-20 mb-6 w-full overflow-hidden rounded-2xl">
                @if($post->image)
                    <img
                        class="z-10 w-full transform group-hover:scale-105 transition ease-in-out duration-1000"
                        src="{{ $post->image_url }}"
                        alt="{{ $post->image_alt ?? $post->title }}"
                    >
                @endif
            </div>

            <p class="mb-3 {{ $compact ? 'text-base' : 'text-2xl' }} font-bold text-white font-medium leading-tight break-words">
                {{ $post->title }}
            </p>

            <p class="mb-4 {{ $compact ? 'text-sm' : 'text-base' }} text-gray-400 break-words leading-snug">
                {{ $post->preview }}
            </p>

            <div class="flex items-center justify-between">
                <div class="{{ $compact ? 'text-sm' : 'text-base' }} underline group-hover:no-underline">
                    {{ __('laravel-blog::posts.Read more') }}
                </div>

                <div>
                    <span class="text-xs text-gray-400 font-medium mb-4">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
