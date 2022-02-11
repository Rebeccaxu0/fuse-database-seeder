@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FUSE{{ strlen($title) ? ': ' . $title : '' }}</title>
    @stack('styles')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.js"></script> -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-fuse-background {{ $roleClass }}">

    <x-navbar>
        <x-admin-subnav />
        <x-student-subnav />
        <x-facilitator-subnav />
    </x-navbar>

    {{ $slot }}

    @stack('modals')

    @stack('scripts')
    @livewireScripts
</body>

</html>
