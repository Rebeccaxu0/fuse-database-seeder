<div class="inline-block h-full">
    <button
      wire:click="$set('showEditModal', true)"
      alt="{{ __('Edit') }}"
      title="{{ __('Edit') }}"
      class="py-2 px-5 h-full
             border-fuse-teal-dk border {{ $user->is_facilitator() ? 'rounded-xl' : 'rounded-l-xl' }}
             text-fuse-teal-dk hover:text-white hover:bg-fuse-green-900
             text-white text-center inline-block">{{
      __('Edit')
      }}</button>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">
              {{ __('Edit :full_name (:name)', ['full_name' => $user->full_name, 'name' => $user->name]) }}
            </x-slot>

            <x-slot name="content">
                <label for="name-{{ $user->id }}">{{ __('Username') }}</label>
                <input
                    type="text"
                    name="name-{{ $user->id }}"
                    id="name-{{ $user->id }}"
                    wire:model="user.name" />
                @error('user.name')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
