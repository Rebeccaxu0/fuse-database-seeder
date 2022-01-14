@props(['route', 'activeColor'])

<li class='flex-1 py-4 md:p-0 m-0 list-none border-t last:border-b md:border-b-0 md:border-t-0 md:border-r first:md:border-l last:md:border-b-0 border-white max-w-none'
    @if (request()->routeIs($route)) style="background-color:{{ $activeColor }}" @endif>
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
