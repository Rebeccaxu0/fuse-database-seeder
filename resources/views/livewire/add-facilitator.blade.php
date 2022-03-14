<div class="relative mb-4">
    @livewire ('user-search-bar')

    @foreach ($selectedusers as $id => $user)
        <div>
            <input type="hidden" name="facilitatorsToAdd[]" value="{{ $id }}"> {{ $user['full_name'] }}
            {{ $user['name'] }}
            <button class="inline-flex" wire:click="removeUser({{ $id }})">
                <img class="h-6 w-6" src="/deletetrash.svg"/>
            </button>
        </div>
    @endforeach
</div>
