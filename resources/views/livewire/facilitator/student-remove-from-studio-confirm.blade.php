<div class="inline-block h-full">
    <button
      wire:click="$set('showDeleteModal', true)"
      alt="{{ __('Delete') }}"
      title="{{ __('Delete') }}"
      class="-ml-1.5 py-2 px-2 h-full
             border-fuse-teal-dk border rounded-r-xl
             text-fuse-teal-dk hover:text-white hover:bg-fuse-red
             text-white text-center inline-block">{{
      __('Remove')
      }}</button>
    <form wire:submit.prevent="submit">
        <x-jet-confirmation-modal wire:model="showDeleteModal">
            <x-slot name="title">
                <span class="text-red-500">
                    {{ __('Remove :full_name (:name) from Studio?', ['full_name' => $student->full_name, 'name' => $student->name]) }}
                </span>
            </x-slot>

            <x-slot name="content">
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Confirm') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </form>
</div>
