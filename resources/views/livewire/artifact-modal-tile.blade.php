<div>
    <button wire:click="$set('showModalFlag', true)"
      class="bg-white border relative cursor-pointer rounded-lg p-4 aspect-[17/14] shadow-tile w-full">
        <x-artifact-tile-content :artifact="$artifact" :studio="$studio" />
    </button>

    <x-jet-modal wire:model="showModalFlag">
        <div class="p-4">
            <div class="pb-4 relative text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
                @if ($artifact->level->levelable::class == App\Models\Idea::class)
                <span class="tracking-tight mr-1">{{ __('My Idea') }}</span> <span class="font-light">{{ $title }}</span>
                @else
                <span class="tracking-tight mr-1">{{ $title }}</span> <span class="font-light">{{ $title_modifier }}</span>
                @endif
                <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
                    <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
                </button>
            </div>

            <x-artifact-modal-content :artifact="$artifact" :studio="$studio" />
        </div>
    </x-jetmodal>
</div>

