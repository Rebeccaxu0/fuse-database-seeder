<div class="inline">
    <a class="cursor-pointer" wire:click="$set('showModalFlag', true)">
        {{ $linkText }}
    </a>
    <x-jet-modal wire:model="showModalFlag">
            <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
                <button class="absolute right-0 top-0 m-2" wire:click="$set('showModalFlag', false)">
                    <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
                </button>
            </div>

            <div class="mx-4 mb-4 text-3xl text-fuse-teal-dk text-center font-semibold">
                {{ $name }}
            </div>

            <div class="m-4">{{ $body }}</div>

        </x-jetmodal>
</div>
