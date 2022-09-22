@push('scripts')
    <script src="https://fast.wistia.com/embed/medias/sq1ojbctj3.jsonp" async></script>
    <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
@endpush

<div>
    <a class="cursor-pointer" wire:click="$set('showModalFlag', true)">
    {{ __('Watch Ideas Trailer Again') }}
    </a>
    <x-jet-modal wire:model="showModalFlag" :deferEntangle="false">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <button class="absolute right-0 top-0 m-2" wire:click="$set('showModalFlag', false)">
                <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <div class="mx-4 mb-4 text-3xl text-fuse-teal-dk text-center font-semibold">
            {{ __('My Idea Trailer')  }}
        </div>

        <div class="m-4 wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
                <div class="wistia_embed wistia_async_sq1ojbctj3 seo=false videoFoam=true" style="height:100%;position:relative;width:100%">
                    <div class="wistia_swatch" style="height:100%;left:0;opacity:0;overflow:hidden;position:absolute;top:0;transition:opacity 200ms;width:100%;">
                        <img src="https://fast.wistia.com/embed/medias/sq1ojbctj3/swatch" style="filter:blur(5px);height:100%;object-fit:contain;width:100%;" alt="" aria-hidden="true" onload="this.parentNode.style.opacity=1;" />
                    </div>
                </div>
            </div>
        </div>
    </x-jetmodal>
</div>
