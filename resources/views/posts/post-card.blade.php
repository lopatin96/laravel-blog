<div class="w-full md:w-1/3 p-8">
    <div class="p-4 h-full bg-gray-900 bg-opacity-70 rounded-xl">
        <div class="flex flex-col justify-between h-full">
            <div class="mb-8 break-all">
                <div class="relative z-20 mb-9 w-full overflow-hidden rounded-2xl">
                    @if ($post->image)
                        <img
                            class="z-10 w-full transform hover:scale-105 transition ease-in-out duration-1000"
                            src="/blog/{{ $post->slug }}/image"
                            alt=""
                        >
                    @endif
                </div>
                <p class="mb-3 text-xl font-bold text-gray-400 font-medium">
                    {{ $post->title }}
                </p>
                <a
                    class="inline-block text-white hover:text-gray-200 hover:underline"
                    href="/blog/{{ $post->slug }}"
                >
                    <h3 class="text-sm font-heading leading-normal">
                        {{ strip_tags(substr($post->body, 0, 255)) }}
                    </h3>
                </a>
            </div>
            <p class="text-sm text-gray-400 font-medium">
                {{ $post->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
</div>
