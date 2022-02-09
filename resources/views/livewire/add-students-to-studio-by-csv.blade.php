<div class="inline-block h-full">
    <span
      wire:click="$set('showImportStudentsByCsvModal', true)"
      alt="{{ __('CSV Student Import') }}"
      title="{{ __('CSV Student Import') }}"
      class="cursor-pointer
             py-2 px-2 h-full
             border-fuse-teal-dk border border-b-2 rounded-xl
             text-fuse-teal-dk hover:text-white hover:bg-fuse-green-900
             text-center uppercase inline-block">{{
      __('CSV Student Import')
      }}</span>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showImportStudentsByCsvModal">
            <x-slot name="title">
            </x-slot>

            <x-slot name="content">
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showImportStudentsByCsvModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
