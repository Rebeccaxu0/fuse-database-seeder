<div>
    <button wire:click="$set('showModalFlag', true)"
      class="cursor-pointer float-right">
        <x-artifact-preview-image :artifact="$artifact" class="h-44 mt-2"/>
    </button>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <span class="tracking-tight mr-1">{{ $title }}</span> <span class="font-light">{{ $title_modifier }}</span>
            <button class="absolute right-0 top-0 mt-2 mr-2" wire:click="$set('showModalFlag', false)">
                <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <x-artifact-modal-content :artifact="$artifact" :studio="$studio" />
    </x-jet-modal>
</div>

