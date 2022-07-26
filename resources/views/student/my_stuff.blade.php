<x-app-layout>
    <x-slot name="title">{{ __('MyStuff') }}</x-slot>
    <x-slot name="header">{{ __('MyStuff') }}</x-slot>

    <div class="my-6">
      Knobs and dials - Filters and sorts
    </div>

    <div class="sm:hidden">
      {{ $artifacts->links() }}
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-8">
    @forelse ($artifacts as $artifact)
        <livewire:artifact-modal-tile :artifact="$artifact" :studio="$studio" :wire:key="$artifact->id">
    @empty
        <p class="col-span-3">{{ __("No Artifacts. Upload a Save or Complete and you'll see it here.") }}</p>
    @endforelse
    </div>

    {{ $artifacts->links() }}
</x-app-layout>
