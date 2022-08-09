<div class="relative mb-4">
    @livewire ('user-search-bar')

    @foreach ($selectedusers as $id => $user)
        <div>
            <input type="hidden" name="facilitatorsToAdd[]" value="{{ $id }}"> {{ $user['full_name'] }}
            {{ $user['name'] }}
            <button class="inline-flex" wire:click="removeUser({{ $id }})">
                <x-icon icon="trash" width=25 height=25 class="inline ml-2 text-black" />
            </button>
        </div>
    @endforeach
</div>
