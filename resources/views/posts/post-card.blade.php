<div class="w-full md:w-1/3 p-8">
    <div class="p-4 h-full bg-gray-900 bg-opacity-70 rounded-xl">
        <div class="flex flex-col justify-between h-full">
            <div class="mb-8 break-all">
                <div class="relative z-20 mb-6 w-full overflow-hidden rounded-2xl">
                    @if ($post->image)
                        <img
                            class="z-10 w-full transform hover:scale-105 transition ease-in-out duration-1000"
                            src="/blog/{{ $post->slug }}/image"
                            alt="{{ $post->title }}"
                        >
                    @endif
                </div>
                <p class="text-xs text-gray-400 font-medium mb-4">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mb-3 text-2xl font-bold text-gray-400 font-medium">
                    {{ $post->title }}
                </p>
                <p class="mb-4 text-gray-500 leading-relaxed break-words text-white">
                    {{ strip_tags(substr($post->body, 0, 255)) }}
                </p>

                <a
                    class="text-lg font-medium text-red-500 underline hover:no-underline"
                    href="/blog/{{ $post->slug }}"
                >{{ __('laravel-blog::posts.Read more') }}</a>
            </div>
        </div>
    </div>
</div>
