<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @livewireStyles

    <!-- Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <x-navbar>
        <x-guest-subnav />
    </x-navbar>

    <div class="pt-12 bg-gradient-to-t from-fuse-teal-dk to-fuse-teal">
        {{ $slot }}
    </div>
    <x-footer />

    @stack('scripts')
    @livewireScripts
</body>

</html>
