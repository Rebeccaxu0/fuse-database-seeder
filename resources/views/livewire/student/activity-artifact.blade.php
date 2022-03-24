<div>
    <button wire:click="$set('showModalFlag', true)"
      class="cursor-pointer p-4 mb-2 relative rounded-lg bg-white w-full shadow-tile">
        <span class="absolute right-0 top-0 mt-1 mr-2 text-xs">
            {{ $timeAgo }} ({{ $artifact->created_at->format('Y-m-d') }})</span>
        </span>
    </button>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <span class="tracking-tight mr-1">{{ $title }}</span> <span class="font-light">{{ $title_modifier }}</span>
            <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
                <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <x-artifact-modal-content :artifact="$artifact" :studio="$studio" />
    </x-jet-modal>
</div>

