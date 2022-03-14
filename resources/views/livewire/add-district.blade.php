<div class="relative">
    @livewire ('district-search-bar')

    @foreach ($selecteddistricts as $id => $district)
        <div>
            <input type="hidden" name="districtsToAdd[]" value="{{ $id }}">{{ $district['name'] }}
            <button class="inline-flex" wire:click="removeDistrict({{ $id }})">
                <img class="h-6 w-6" src="/deletetrash.svg">
            </button>
        </div>
    @endforeach
</div>
