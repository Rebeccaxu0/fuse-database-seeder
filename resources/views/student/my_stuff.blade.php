<x-app-layout>

    <x-slot name="title">{{ __('MyStuff') }}</x-slot>

    <x-slot name="header">{{ __('MyStuff') }}</x-slot>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    @forelse ($artifacts as $artifact)
        <livewire:artifact-modal-tile :artifact="$artifact" :wire:key="$artifact->id">
    @empty
        <p class="col-span-3">{{ __("No Artifacts. Upload a Save or Complete and you'll see it here.") }}</p>
    @endforelse
    </div>

    {{ $artifacts->links() }}
</x-app-layout>
