<div>
    <span
      wire:click="$set('showModalFlag', true)"
      alt="{{ __('Join a new studio') }}"
      title="{{ __('Join a new studio') }}"
      class="cursor-pointer ml-2 leading-[0.9rem] border-2 border-fuse-green text-fuse-green rounded-xl h-5 w-5 text-center inline-block">+</span>
    </a>
    <x-jet-dialog-modal wire:model="showModalFlag">
      <x-slot name="title">
        {{ __('Join a Studio') }}
      </x-slot>

      <x-slot name="content">
        {{ __('Enter Studio Code') }}
        <input>
      </x-slot>

      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showModalFlag')" wire:loading.attr="disabled">
          {{ __('Cancel') }}
        </x-jet-secondary-button>
        <x-jet-button wire:click="$toggle('showModalFlag')" wire:loading.attr="disabled">
        {{ __('Submit') }}
        </x-jet-button>
      </x-slot>
    </x-jet-dialog-modal>
</div>
