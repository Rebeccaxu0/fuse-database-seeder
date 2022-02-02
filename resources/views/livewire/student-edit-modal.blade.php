<div class="inline-block h-full">
    <span
      wire:click="$set('showEditModal', true)"
      alt="{{ __('Edit') }}"
      title="{{ __('Edit') }}"
      class="cursor-pointer
             py-2 px-5 h-full
             bg-fuse-green rounded-l-xl
             text-white text-center inline-block">{{
      __('Edit')
      }}</span>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">
              {{ __('Edit Student :name', ['name' => $student->name]) }}
            </x-slot>

            <x-slot name="content">
                <label for="studio_code">{{ __('Name') }}</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    wire:model="name" />
                @error('name')
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
                    {{ __('Submit') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
