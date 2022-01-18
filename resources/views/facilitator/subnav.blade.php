<x-subnav id="facilitator" hamburger-color="text-black">
    <x-subnav-ul id="facilitator-menu">
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
        @if (Auth::user()->is_super_facilitator())
        <li>
            <a class="px-2 {{ request()->routeIs('admin.studios.index') ? 'active' : '' }}"
                href="{{ route('admin.studios.index') }}">{{ __('Super') }}</a>
        </li>
        @endif
    </x-subnav-ul>
</x-subnav>
