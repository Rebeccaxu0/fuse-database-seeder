<div class="cursor-pointer">
    <span
      wire:click="$set('showModalFlag', true)"
      title="{{ __('Join a new studio') }}"
      class="cursor-pointer ml-2 leading-[0.9rem] border-2 border-fuse-green text-fuse-green rounded-xl h-5 w-5 text-center inline-block">+</span>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showModalFlag">
            <x-slot name="title">
                {{ __('Join a Studio') }}
            </x-slot>

            <x-slot name="content">
                <label for="studio_code">{{ __('Enter Studio Code') }}</label>
                <input
                    type="text"
                    name="studio_code"
                    id="studio_code"
                    placeholder="{{ __('e.g. White Wolf 123') }}"
                    wire:model="studioCode" />
                @error('studioCode')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showModalFlag')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Submit') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
