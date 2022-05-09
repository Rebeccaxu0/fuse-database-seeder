@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $roleClass }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FUSE{{ strlen($title) ? ': ' . $title : '' }}</title>
    @stack('styles')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    @livewireStyles

    <!-- Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
