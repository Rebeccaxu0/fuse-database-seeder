<x-navbar id="admin">
    <x-navbar-ul id="admin-menu">
        <li>
            <a class="px-2 {{ request()->routeIs('admin.packages.index') ? 'active' : '' }}"
                href="{{ route('admin.packages.index') }}">{{ __('Packages') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin.districts.index') ? 'active' : '' }}"
                href="{{ route('admin.districts.index') }}">{{ __('Districts') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin.schools.index') ? 'active' : '' }}"
                href="{{ route('admin.schools.index') }}">{{ __('Schools') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin.studios.index') ? 'active' : '' }}"
                href="{{ route('admin.studios.index') }}">{{ __('Studios') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin.challenges.index') ? 'active' : '' }}"
                href="{{ route('admin.challenges.index') }}">{{ __('Challenges') }}</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin') ? 'active' : '' }}"
                href="{{ route('admin') }}">{{ __('Administrivia') }}</a>
        </li>
    </x-navbar-ul>
</x-navbar>
