@extends('posts.base')

@section('content')
    <section class="pt-24 pb-36 bg-black overflow-hidden">
        <div class="container px-4 mx-auto max-w-6xl">
            <h2 class="mb-6 text-6xl md:text-8xl xl:text-10xl text-white font-bold font-heading tracking-px-n leading-none">
                {{ __('blog.Our Latest Articles') }}
            </h2>
            <div class="flex flex-wrap">
                @if (count($articles) > 0)
                    @foreach ($articles as $article)
                        <x-blog-card :article="$article" />
                    @endforeach
                @else
                    <p class="text-gray-400">
                        {{ __('blog.No articles') }}
                    </p>
                @endif
            </div>
        </div>
    </section>
@endsection
