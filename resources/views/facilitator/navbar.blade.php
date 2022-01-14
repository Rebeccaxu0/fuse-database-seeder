<x-navbar id="facilitator" hamburger-color="text-black">
    <x-navbar-ul id="facilitator-menu">
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.activity') ? 'active' : '' }}"
                href="{{ route('facilitator.activity') }}">{{ __('Studio Activity') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.people') ? 'active' : '' }}"
                href="{{ route('facilitator.people') }}">{{ __('People') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.challenges') ? 'active' : '' }}"
                href="{{ route('facilitator.challenges') }}">{{ __('Challenges') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.comments') ? 'active' : '' }}"
                href="{{ route('facilitator.comments') }}">{{ __('Comments') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.settings') ? 'active' : '' }}"
                href="{{ route('facilitator.settings') }}">{{ __('Settings') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.announcements') ? 'active' : '' }}"
                href="{{ route('facilitator.announcements') }}">{{ __('Announcements') }}</a>
        </li>
    </x-navbar-ul>
</x-navbar>
