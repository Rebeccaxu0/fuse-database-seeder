<x-navbar id="admin">
  <x-navbar-ul id="admin-menu">
    <li>
      <a {{ (request()->routeIs('admin.packages.index') ? 'class=active' : '') }}
         href="{{ route('admin.packages.index')}}">{{ __('Packages') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('admin.districts.index') ? 'class=active' : '') }}
         href="{{ route('admin.districts.index')}}">{{ __('Districts') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('admin.schools.index') ? 'class=active' : '') }}
         href="{{ route('admin.schools.index')}}">{{ __('Schools') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('admin.studios.index') ? 'class=active' : '') }}
         href="{{ route('admin.studios.index')}}">{{ __('Studios') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('admin.challenges.index') ? 'class=active' : '') }}
         href="{{ route('admin.challenges.index')}}">{{ __('Challenges') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('admin') ? 'class=active' : '') }}
         href="{{ route('admin')}}">{{ __('Administrivia') }}</a>
    </li>
  </x-navbar-ul>
</x-navbar>