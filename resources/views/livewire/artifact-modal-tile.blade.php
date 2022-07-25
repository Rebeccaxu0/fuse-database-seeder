<div>
    <button wire:click="$set('showModalFlag', true)"
      class="bg-white border relative cursor-pointer rounded-lg p-4 aspect-[17/14] shadow-tile w-full">
        <x-artifact-tile-content :artifact="$artifact" :studio="$studio" />
    </button>

    <x-jet-modal wire:model="showModalFlag">
        <x-artifact-modal-content :artifact="$artifact" :studio="$studio" />
    </x-jetmodal>
</div>

