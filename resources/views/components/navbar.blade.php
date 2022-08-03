@push('scripts')
    <script>
        window.onscroll = function() {
            document.getElementById('navbar').classList.
            toggle('docked', toggleDock());
            document.getElementsByTagName('html')[0].classList.
            toggle('docked', toggleDock());
        };
        function toggleDock() {
            return document.documentElement.scrollTop > 50;
        }
    </script>
@endpush

<nav id="navbar" class="z-10 md:fixed w-full md:top-0 shadow-lg">
    {{ $slot }}
</nav>
