<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>  
        
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <style type="text/css">
                @media (max-width: 2000px) {
                    input#nav-toggle:checked~label#show-button {
                        display: none;
                    }
                    input#nav-toggle:checked~label#hide-button {
                        display: flex;
                    }
                    input#nav-toggle:checked~#nav-menu {
                        display: block;
                        border-radius: 6px;
                    }
                    #nav-menu {margin-top:4rem;}
                }
            </style>
    </head>
    <body class="bg-gradient-to-t from-fuse-dk-teal to-fuse-teal">
    <div>
        {{ $slot }}
    </div>
    </body>
</html>