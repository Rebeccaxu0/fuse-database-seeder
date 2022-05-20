<div>
    @foreach ($announcements as $a)
    <div class="bg-fuse-lt-blue py-8 grid grid-cols-12">
        <div class="col-span-2 lg:col-span-1">
            <span class="float-right mr-2 text-white bg-fuse-green rounded-xl py-1 px-3 uppercase text-sm">{{ __($a->type) }}</span>
        </div>
        <div class="col-span-9 lg:col-span-10">
            @if ($a->url)
            <a class="underline text-black" href="{{ $a->url }}" target="_blank">{{ $a->body }}</a>
            @else
            {{ $a->body }}
            @endif
        </div>
        <button wire:click="dismiss({{ $a->id }})" class="float-left border-2 border-black rounded-xl w-8 h-8 text-2xl uppercase">x</button>
    </div>
    @endforeach
</div>
