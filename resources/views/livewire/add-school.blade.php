<div class="relative">
    @livewire ('school-search-bar')

    @foreach ($selectedschools as $id => $school)
        <div>
            <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ $school['name'] }}
            <button class="inline-flex" wire:click="removeUser({{ $id }})">
                <x-icon icon="trash" width=25 height=25 class="inline ml-2 text-black" />
            </button>
        </div>
    @endforeach
</div>
