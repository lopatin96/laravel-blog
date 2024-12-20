@extends('laravel-blog::posts.base')

@section('content')
    <section>
        <h2 class="mb-6 text-3xl md:text-5xl text-white font-bold font-heading tracking-px-n leading-none">
            {{ __('laravel-blog::posts.Our Latest Articles') }}
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    @include('laravel-blog::posts.post-card', ['post' => $post])
                @endforeach
            @else
                <p class="text-gray-400">
                    {{ __('laravel-blog::posts.No articles') }}
                </p>
            @endif
        </div>

        <div class="mt-5">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
