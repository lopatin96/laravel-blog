@extends('laravel-blog::posts.base')

<x-laravel-seo::title :strict-title="$post->meta_title ?: $post->title" />
<x-laravel-seo::description :description="$post->meta_description" />

@section('content')
    <section class="pt-12 pb-36 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-4xl break-all">
            <div class="mx-5 sm:mx-0">
                <x-laravel-ui-components::breadcrumbs :breadcrumbs="[
                    ['title' => __('laravel-blog::posts.Blog'), 'route' => 'blog.index'],
                    ['title' => '…'],
                ]" />
            </div>

            <article class="prose prose-invert lg:prose-xl mx-auto break-normal">
                <h1 class="mt-5 mb-12 text-white font-bold font-heading tracking-px-n leading-none">
                    {{ $post->title }}
                </h1>

                <img
                    class="object-cover md:rounded-lg mb-16"
                    src="{{ $post->image_url }}"
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
