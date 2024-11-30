<div class="w-full md:w-1/3 p-8">
    <div class="p-4 h-full bg-gray-900 bg-opacity-70 rounded-xl">
        <div class="flex flex-col justify-between h-full">
            <div class="relative z-20 mb-6 w-full overflow-hidden rounded-2xl">
                @if($post->image)
                    <img
                        class="z-10 w-full transform hover:scale-105 transition ease-in-out duration-1000"
                        src="{{ $post->image_url }}"
                        alt="{{ $post->title }}"
                    >
                @endif
            </div>

            <p class="mb-3 text-2xl font-bold text-gray-400 font-medium">
                {{ $post->title }}
            </p>

            <p class="mb-4 text-gray-100 leading-relaxed break-words leading-snug">
                {{ $post->preview }}
            </p>

            <div class="flex items-center justify-between">
                <div>
                    <a
                        class="text-lg font-medium text-red-500 underline hover:no-underline"
                        href="/blog/{{ $post->slug }}"
                    >{{ __('laravel-blog::posts.Read more') }}</a>
                </div>

                <div>
                    <span class="text-xs text-gray-400 font-medium mb-4">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
