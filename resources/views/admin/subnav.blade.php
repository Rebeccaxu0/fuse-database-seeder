<x-subnav id="admin">
    <x-subnav-ul id="admin-menu">
        <li>
            <a class="px-2 {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                href="{{ route('admin.challengeversions.index') }}">Challenges</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin.studios.index') ? 'active' : '' }}"
                href="{{ route('admin.studios.index') }}">Studios</a>
        </li>
        <li>
            <a class="px-2 {{ request()->routeIs('admin') ? 'active' : '' }}"
                href="{{ route('admin') }}">Administrivia</a>
        </li>
    </x-subnav-ul>
</x-subnav>
