<div class="relative">
    @livewire ('district-search-bar')

    @foreach ($selecteddistricts as $id => $district)
        <div>
            <input type="hidden" name="districtsToAdd[]" value="{{ $id }}"> {{ $district['name'] }}
        </div>
    @endforeach
</div>
