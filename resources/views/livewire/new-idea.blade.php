<div class="border-dashed border-[12px] border-white rounded-xl">
    <button wire:click="$set('showModalFlag', true)"
      class="aspect-square w-full relative rounded-lg p-4 text-center">
        <x-icon icon="idea" viewBox="60.4 93.6" width="250" height="250"
            fill="currentColor"
            alt="{{ __('New Idea') }}"
            class="text-white" />
    </button>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
              <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <div class="mx-4 mb-4 relative overflow-hidden">
            <div class="w-full bg-blue-200 rounded-lg">
            </div>
        </div>

        <div class="text-right mx-4 mb-8">
          Idea Form
        </div>

    </x-jetmodal>
</div>

