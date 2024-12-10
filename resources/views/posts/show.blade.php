@extends('laravel-blog::posts.base')

<x-laravel-seo::title :strict-title="$post->meta_title ?: $post->title" />
<x-laravel-seo::description :description="$post->meta_description" />

@section('content')
    <section class="py-12 bg-black overflow-hidden">
        <div class="container px-4 mx-auto break-all">
            <div class="mb-5">
                <x-laravel-ui-components::breadcrumbs :breadcrumbs="[
                    ['title' => __('laravel-blog::posts.Blog'), 'route' => 'blog.index'],
                    ['title' => '…'],
                ]" />
            </div>

            <article class="prose prose-invert lg:prose-xl mx-auto break-normal">
                <h1 class="mt-5 mb-12 text-white font-bold font-heading tracking-px-n leading-none">
                    {{ $post->title }}
                </h1>

                @if($post->image)
                    <img
                        class="sm:float-right sm:ml-4 mb-4 w-64 sm:w-72 md:w-96 object-cover sm:rounded-lg mb-16 mx-auto"
                        src="{{ $post->image_url }}"
                        alt="{{ $post->image_alt ?? $post->title }}"
                    >
                @endif

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

    <section class="py-12 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-5xl">
            <h2 class="mb-6 text-3xl md:text-5xl text-white font-bold font-heading tracking-px-n leading-none">
                {{ __('laravel-blog::posts.Our Latest Articles') }}
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                @if(count($recentPosts) > 0)
                    @foreach($recentPosts as $post)
                        @include('laravel-blog::posts.post-card', ['post' => $post, 'compact' => true])
                    @endforeach
                @else
                    <p class="text-gray-400">
                        {{ __('laravel-blog::posts.No articles') }}
                    </p>
                @endif
            </div>
        </div>
    </section>
@endsection
