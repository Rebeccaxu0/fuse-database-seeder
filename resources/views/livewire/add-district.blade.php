<div class="relative">
    @if (! $district)
        @livewire ('district-search-bar')
    @else
        <div>
            <input type="hidden" name="district" value="{{ $district->id }}">{{ $district->name }}
            <button class="inline-flex" wire:click="removeDistrict()">
                <x-icon icon="trash" />
            </button>
        </div>
    @endif
</div>
