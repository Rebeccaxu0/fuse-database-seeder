@push('scripts')
    <script>
        window.onscroll = function() {
            document.getElementById('student-navbar').classList.
            toggle('docked', toggleDock());
            document.getElementsByTagName('html')[0].classList.
            toggle('docked', toggleDock());
        };
        function toggleDock() {
            return document.documentElement.scrollTop > 50;
        }
    </script>
@endpush

<x-subnav id="student">
    <!-- Logo -->
    <div class="absolute t-0 l-0 z-10 mt-3">
        <a href="{{ route('student.dashboard') }}">
            <img src="/logo.png" alt="logo" class="w-20">
        </a>
    </div>
    <x-subnav-ul id="student-menu" class="md:pl-3 md:pr-20 md:ml-16">
        <li class="md:-ml-3">
            <a class="px-2 {{ request()->routeIs('student.challenges') ? 'active' : '' }}"
                href="{{ route('student.challenges') }}">{{ __('Challenges') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('student.help_finder') ? 'active' : '' }}"
                href="{{ route('student.help_finder') }}">{{ __('Help Finder') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                href="{{ route('student.dashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('student.my_stuff') ? 'active' : '' }}"
                href="{{ route('student.my_stuff') }}">{{ __('My Stuff') }}</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="h-full">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Sign Out') }}
                </a>
            </form>
        </li>
    </x-subnav-ul>
    <div id="profile-env" class="h-16 flex flex-col justify-center absolute top-0 right-0 mr-16 md:mr-4">
        <a href="{{ route('profile.show') }}">
            <x-avatar id="profile-pic" :user="auth()->user()" class="border-white border-2"/>
        </a>
    </div>
</x-subnav>
