<div class="relative">
    @livewire ('studio-search-bar')

    @foreach ($selectedstudios as $id => $studio)
        <div>
            <input type="hidden" name="studiosToAdd[]" value="{{ $id }}">{{ $studio['name'] }} <span
                class="inline-flex"> <img wire:click="removeStudio({{ $id }})" class="h-6 w-6"
                    src="/deletetrash.png"> </span>
        </div>
    @endforeach
</div>

