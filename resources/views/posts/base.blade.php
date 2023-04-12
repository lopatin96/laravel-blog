<x-guest-layout>
    @include(config('blog.header_path'))

    @yield('content')

    @include(config('blog.footer_path'))
</x-guest-layout>
