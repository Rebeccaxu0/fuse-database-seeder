<div class="inline-block h-full">
    <span
      wire:click="$set('showDeleteModal', true)"
      alt="{{ __('Delete') }}"
      title="{{ __('Delete') }}"
      class="cursor-pointer -ml-2
             py-2 px-2 h-full
             bg-red-500 rounded-r-xl
             text-white text-center inline-block">{{
      __('Delete')
      }}</span>
    <form wire:submit.prevent="submit">
        <x-jet-confirmation-modal wire:model="showDeleteModal">
            <x-slot name="title">
              {{ __('Delete Student :name?', ['name' => $student->name]) }}
            </x-slot>

            <x-slot name="content">
                <span class="text-red-500">
                  {{ __('This is a permanent action.') }}
                </span>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </form>
</div>
