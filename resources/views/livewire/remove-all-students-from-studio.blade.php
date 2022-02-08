<div class="inline-block h-full">
    <span
      wire:click="$set('showRemoveModal', true)"
      alt="{{ __('Remove all students') }}"
      title="{{ __('Remove all students') }}"
      class="cursor-pointer -ml-2
             py-2 px-2 h-full
             bg-red-500 rounded-xl
             text-white text-center inline-block">{{
      __('Remove all students')
      }}</span>
    <form wire:submit.prevent="submit">
        <x-jet-confirmation-modal wire:model="showRemoveModal">
            <x-slot name="title">
              {{ __('Remove all students from :studio_name', ['studio_name' => $studio_display]) }}
            </x-slot>

            <x-slot name="content">
                <span class="text-red-500">
                  {{ __('This is a permanent action.') }}
                </span>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showRemoveModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Remove all students') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </form>
</div>
