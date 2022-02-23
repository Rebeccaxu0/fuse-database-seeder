<div class="relative">
    @livewire ('school-district-search-bar')

    @foreach ($selecteddss as $id => $ds)
        <div>
            <input type="hidden" name="dssToAdd[]" value="{{ $id }}">{{ $ds['name'] }} <span
                class="inline-flex"> <img wire:click="removeUser({{ $id }})" class="h-6 w-6"
                    src="/deletetrash.png"> </span>
        </div>
    @endforeach
</div>