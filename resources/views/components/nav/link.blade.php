@props(['active', 'active_bg' => 'bg-fuse-teal-500'])

@php
$classes = 'inline-flex items-center px-1 pt-1 border-r border-blue-300 uppercase text-sm font-medium leading-5 transition ';
$classes .= ($active ?? false)
            ? 'text-white focus:outline-none focus:border-indigo-700 ' . $active_bg
            : 'text-gray-300 hover:text-gray-100 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
