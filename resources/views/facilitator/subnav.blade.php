<x-subnav id="facilitator" hamburger-color="text-black">
    <x-subnav-ul id="facilitator-menu">
        @if (Auth::user()->activeStudio->deFactoPackage->student_activity_tab_access)
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.activity') ? 'active' : '' }}"
                href="{{ route('facilitator.activity') }}">{{ __('Activity') }}</a>
        </li>
        @endif
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.people') ? 'active' : '' }}"
                href="{{ route('facilitator.people') }}">{{ __('People') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.challenges') ? 'active' : '' }}"
                href="{{ route('facilitator.challenges') }}">{{ __('Open Challenges') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.settings') ? 'active' : '' }}"
                href="{{ route('facilitator.settings') }}">{{ __('Settings') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.announcements') ? 'active' : '' }}"
                href="{{ route('facilitator.announcements') }}">{{ __('Support') }}</a>
        </li>
        @if (Auth::user()->isSuperFacilitator())
        <li>
            <a class="px-2 {{ request()->routeIs('admin.studios.index') ? 'active' : '' }}"
                href="{{ route('admin.studios.index') }}">{{ __('Super') }}</a>
        </li>
        @endif
        @if (Auth::user()->activeStudio->allow_comments)
        <li>
            <a class="px-2 {{ request()->routeIs('facilitator.comments') ? 'active' : '' }}"
                href="{{ route('facilitator.comments') }}">{{ __('Comments') }}</a>
        </li>
        @endif
    </x-subnav-ul>
</x-subnav>
