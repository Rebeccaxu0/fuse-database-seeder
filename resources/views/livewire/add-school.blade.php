<div class="relative">
    @livewire ('school-search-bar')

    @foreach ($selectedschools as $id => $school)
        <div>
            <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ $school['name'] }}
            <button class="inline-flex" wire:click="removeUser({{ $id }})">
                <img class="h-6 w-6" src="/deletetrash.svg"/>
            </button>
        </div>
    @endforeach
</div>
