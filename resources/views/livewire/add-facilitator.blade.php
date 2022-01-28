<div class="relative mb-4">
    @livewire ('user-search-bar')

    @foreach ($selectedusers as $id => $user)
        <div>
            <input type="hidden" name="facilitatorsToAdd[]" value="{{ $id }}"> {{ $user['full_name'] }}
            {{ $user['name'] }} <span class="inline-flex"> <img wire:click="removeUser({{ $id }})"
                    class="h-6 w-6" src="/deletetrash.png"> </span>
        </div>
    @endforeach
</div>
