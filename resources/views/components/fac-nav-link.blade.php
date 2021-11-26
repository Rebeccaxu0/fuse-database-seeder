@props(['route'])

<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
  <x-nav.link
    href="{{ route($route) }}"
    :active="request()->routeIs($route)">
    {{ $slot }}
  </x-nav.link>
</div>
