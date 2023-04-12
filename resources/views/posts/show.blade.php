@extends('laravel-blog::posts.base')

@section(
    'title',
    config('app.name') . ': ' . ($post->meta_title ?: $post->title)
)

@section('content')
    <section class="pt-12 pb-36 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-6xl break-all">
            <div class="flex justify-between items-center space-x-4 w-full p-4">
                <nav class="py-3 rounded-md w-full">
                    <ol class="list-reset flex">
                        <li>
                            <a href="/blog" class="text-blue-600 hover:text-blue-700 flex space-x-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                </svg>
                                <span>{{ __('laravel-blog::blog.Blog') }}</span>
                            </a>
                        </li>
                        <li><span class="text-gray-500 mx-2">/</span></li>
                        <li class="text-gray-500">{{ __('laravel-blog::blog.Article') }}</b></li>
                    </ol>
                </nav>
            </div>

            <article class="prose prose-invert lg:prose-xl mx-auto px-4 mb-4">
                <h2 class="mt-5 mb-12 text-6xl md:text-8xl xl:text-8xl text-white font-bold font-heading tracking-px-n leading-none">
                    {{ $post->title }}
                </h2>

                <img
                    class="object-cover md:rounded-lg mb-16"
                    src="/blog/{{ $post->slug }}/image"
                    alt="{{ $post->title }}"
                >

                {!! Illuminate\Support\Str::markdown($post->body) !!}

                <span class="inline-block text-xs text-gray-500">
                    <span
                        data-te-toggle="tooltip"
                        title="{{ $post->created_at }}"
                    >
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </span>
            </article>
        </div>
    </section>
@endsection
