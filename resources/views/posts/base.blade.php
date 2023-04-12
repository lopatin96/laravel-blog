<x-guest-layout>
    @include(config('laravel-blog.header_path'))

    @yield('content')

    @include(config('laravel-blog.footer_path'))
</x-guest-layout>
