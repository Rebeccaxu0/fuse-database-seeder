<div class="relative">
    @livewire ('school-district-search-bar')

    @foreach ($selectedschools as $id => $school)
        <div>
            <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ }} <span
                class="inline-flex"> <img wire:click="removeUser({{ $id }})" class="h-6 w-6"
                    src="/deletetrash.svg"> </span>
        </div>
    @endforeach
</div>