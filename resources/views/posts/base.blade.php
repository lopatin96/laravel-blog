<x-guest-layout>
    @include('layouts.header', ['showLinks' => false])
    @yield('content')
</x-guest-layout>
