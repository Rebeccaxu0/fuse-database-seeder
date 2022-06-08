@props(['title' => ''])

<!DOCTYPE html>

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
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-fuse-teal-500">

    <x-navbar>
        <x-student-subnav />
    </x-navbar>

    {{ $slot }}
    <x-footer />


    @stack('modals')

    @stack('scripts')
    @livewireScripts
</body>

</html>