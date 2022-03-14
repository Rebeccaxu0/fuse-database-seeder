<div class="relative">
    @livewire ('studio-search-bar')

    @foreach ($selectedstudios as $id => $studio)
        <div>
            <input type="hidden" name="studiosToAdd[]" value="{{ $id }}">{{ $studio['name'] }}
            <button class="inline-flex" wire:click="removeStudio({{ $id }})">
                <img class="h-6 w-6" src="/deletetrash.svg"/>
            </button>
        </div>
    @endforeach
</div>
