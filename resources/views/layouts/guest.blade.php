@props(['title' => '', 'login' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FUSE{{ strlen($title) ? ': ' . $title : '' }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script async defer data-website-id="{{ env('UMAMI_ID') }}" src="https://umami.fusestudio.net/umami.js"></script>
</head>

<body>
    <x-navbar>
        <x-guest-subnav :login="$login" />
    </x-navbar>

    <div class="pt-12 bg-gradient-to-t from-fuse-teal-dk to-fuse-teal">
        {{ $slot }}
    </div>

    <x-footer />

    @stack('modals')
    @stack('scripts')
    @livewireScripts
</body>

</html>
