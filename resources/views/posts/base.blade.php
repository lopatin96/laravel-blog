<x-guest-layout>
    @include(config('laravel-blog.header_path'))

    <x-laravel-seo::title title='blog.title' />

    <div class="py-12 bg-black">
        <div class="mx-auto max-w-5xl px-5">
            @yield('content')
        </div>
    </div>

    @include(config('laravel-blog.footer_path'))
</x-guest-layout>
