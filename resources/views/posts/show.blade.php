@extends('blog.base')

@section(
    'title',
    config('app.name', 'FlexLink') . ': ' . ($article->meta_title ?: $article->title)
)

@section('content')
    <section class="pt-12 pb-36 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-6xl break-all">
            <x-breadcrumbs
                title="{{ __('blog.Blog') }}"
                route="blog"
            >
                {{ __('blog.Article') }}
            </x-breadcrumbs>

            <article class="prose prose-invert lg:prose-xl mx-auto px-4 mb-4">
                <h2 class="mt-5 mb-12 text-6xl md:text-8xl xl:text-8xl text-white font-bold font-heading tracking-px-n leading-none">
                    {{ $article->title }}
                </h2>

                <img
                    class="object-cover md:rounded-lg mb-16"
                    src="/blog/{{ $article->slug }}/image"
                    alt=""
                >

                {!! Illuminate\Support\Str::markdown($article->body) !!}

                <span class="inline-block text-xs text-gray-500">
                    <span
                        data-te-toggle="tooltip"
                        title="{{ $article->created_at }}"
                    >
                        {{ $article->created_at->diffForHumans() }}
                    </span>
                </span>
            </article>
        </div>
    </section>
@endsection
