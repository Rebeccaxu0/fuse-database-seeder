<x-app-layout>

    <x-slot name="title">{{ __('Announcements') }}</x-slot>

    <x-slot name="header">{{ __('Announcements') }}</x-slot>

    <ul>
    @foreach ($announcements as $announcement)
    <li class="odd:bg-gray-200 p-2 list-none m-0">
        {{ (new \DateTime($announcement->start))->format('Y-m-d') }}
        <span class="mr-2 text-white announcement-tag {{ $announcement->type }} rounded-xl py-1 px-3 uppercase text-sm">{{ __($announcement->type) }}</span>
        @if ($announcement->url)
        <a href="{{ $announcement->url }}" target="_blank">{{ $announcement->body }}</a>
        @else
        {{ $announcement->body }}
        @endif
    </li>
    @endforeach
    </ul>

</x-app-layout>
