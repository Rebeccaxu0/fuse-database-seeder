<x-app-layout>

    <x-slot name="title">{{ __('MyStuff') }}</x-slot>

    <x-slot name="header">{{ __('MyStuff') }}</x-slot>

    @forelse ($artifacts as $artifact)
        <x-artifact-tile :artifact="$artifact" />
    @empty
        <p>{{ __("No Artifacts. Upload a Save or Complete and you'll see it here.") }}</p>
    @endforelse
</x-app-layout>
