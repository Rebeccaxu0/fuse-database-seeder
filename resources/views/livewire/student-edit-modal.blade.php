<div class="cursor-pointer inline-block">
    <span
      wire:click="$set('showEditModal', true)"
      alt="{{ __('Edit') }}"
      title="{{ __('Edit') }}"
      class="cursor-pointer ml-2 leading-[0.9rem] border-2 border-fuse-green text-fuse-green rounded-xl text-center inline-block">{{
      __('edit')
      }}</span>
    </a>
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
