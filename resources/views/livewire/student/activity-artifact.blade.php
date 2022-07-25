<div>
    <button wire:click="$set('showModalFlag', true)"
      class="cursor-pointer float-right">
        <x-artifact-image :artifact="$artifact" class="h-44 mt-2"/>
    </button>

    <x-jet-modal wire:model="showModalFlag">
        <x-artifact-modal-content :artifact="$artifact" :studio="$studio" />
    </x-jet-modal>
</div>

