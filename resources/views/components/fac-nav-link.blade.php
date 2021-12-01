@props(['route'])

<li {{ $attributes->merge(['class' => 'flex-1 py-4 md:p-0 m-0 list-none border-t md:border-t-0 md:border-r border-white max-w-none' . (request()->routeIs($route) ? ' bg-fuse-nav-green' : '')]) }}>
  <a href="{{ route($route) }}"
    class="flex justify-center items-center no-underline
           h-full w-full
           uppercase text-lg md:text-xs lg:text-sm font-medium leading
           text-gray-300 whitespace-nowrap transition
           hover:text-gray-100 hover:border-gray-300
           focus:outline-none focus:text-gray-700 focus:border-gray-300">
    {{ $slot }}
  </a>
</li>
