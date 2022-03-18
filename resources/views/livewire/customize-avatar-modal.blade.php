<div>
    <button wire:click="$set('showModalFlag', true)"
      class="rounded-full duration-200
             bg-white bg-opacity-70 hover:bg-opacity-100
             text-slate-400 hover:text-black text-8
             w-9 h-9 hover:w-12 hover:h-12">
        <span class="sr-only">{{ __('Customize your avatar') }}</span>
        +
    </button>
    <x-jet-modal wire:model="showModalFlag">
        Customize your face.
    </x-jetmodal>
</div>
