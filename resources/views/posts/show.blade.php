@extends('laravel-blog::posts.base')

<x-laravel-seo::title :strict-title="$post->meta_title ?: $post->title" />
<x-laravel-seo::description :description="$post->meta_description" />

@section('content')
    <section class="pt-12 pb-36 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-6xl break-all">
            <div class="flex justify-between items-center space-x-4 w-full p-4">
                <nav class="py-3 rounded-md w-full">
                    <ol class="flex space-x-2">
                        <li>
                            <a href="/blog" class="text-white hover:underline flex space-x-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                </svg>
                                <span>{{ __('laravel-blog::posts.Blog') }}</span>
                            </a>
                        </li>
                        <li class="text-gray-500">/</li>
                        <li class="text-white">{{ $post->title }}</b></li>
                    </ol>
                </nav>
            </div>

            <article class="prose prose-invert lg:prose-xl mx-auto px-4 mb-4 break-normal">
                <h1 class="mt-5 mb-12 text-white font-bold font-heading tracking-px-n leading-none">
                    {{ $post->title }}
                </h1>

                <img
                    class="object-cover md:rounded-lg mb-16"
                    src="/blog/{{ $post->slug }}/image"
                    alt="{{ $post->title }}"
                >

                <div class="leading-normal">
                    {!! Illuminate\Support\Str::markdown($post->body) !!}
                </div>

                <div class="mt-5 flex justify-end">
                    <span
                        data-te-toggle="tooltip"
                        title="{{ $post->created_at }}"
                        class="text-xs text-white"
                    >
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </article>
        </div>
    </section>
@endsection
