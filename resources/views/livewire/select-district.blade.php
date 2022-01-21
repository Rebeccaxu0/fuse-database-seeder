<div class="relative">
    @livewire ('district-search-bar')

    @foreach ($selecteddistricts as $id => $district)
        <div>
            <input type="hidden" name="districtsToAdd[]" value="{{ $id }}">{{ $district['name'] }} <span
                class="inline-flex"> <img wire:click="removeDistrict({{ $id }})" class="h-6 w-6"
                    src="/deletetrash.png"> </span>
        </div>
    @endforeach
</div>

