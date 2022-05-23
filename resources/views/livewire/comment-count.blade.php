<div class="flex items-center font-bold">
    @if ($unseen)
    <x-icon icon="comment" strokeWidth="1.5" class="text-fuse-pink" />
    @else
    <x-icon icon="comment" strokeWidth="1.5" class="text-slate-500" />
    @endif
    {{ $commentCount }}
</div>
