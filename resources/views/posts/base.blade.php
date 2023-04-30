<x-guest-layout>
    @include(config('laravel-blog.header_path'))

    <x-laravel-seo::title title="blog_title" />

    @yield('content')

    @include(config('laravel-blog.footer_path'))
</x-guest-layout>
