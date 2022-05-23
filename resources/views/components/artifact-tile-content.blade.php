<div class="aspect-video w-full"
     {{-- NO WAR --}}
     style="background: linear-gradient(to bottom, #0057b7 50%, #FFD700 50%);">
</div>

<div>
    <span class="text-slate-500 uppercase">{{ $timeAgo }} ({{ $artifact->created_at->format('Y-m-d') }})</span>
    @if ($comments)
    <div class="float-right">
        <livewire:comment-count :artifact="$artifact" />
    </div>
    @endif
</div>

<div class="text-right uppercase font-bold text-slate-500">{{ $artifact->name }}</div>
<div class="text-right uppercase font-bold">{{ $title }}</div>
<div class="absolute bottom-0 left-0 m-4 flex items-center">
    @if ($artifact->level->levelable::class == Idea::class)
    <x-icon icon="idea" viewBox="60.4 90.6" fill="currentColor" alt="{{ __('idea') }}" class="text-orange-500"/>
    @else
    <span class="text-blue-400 text-2xl font-bold">{{ __('L:number', ['number' => $artifact->level->level_number]) }}</span>
    @endif

    <x-icon icon="{{ $artifact->type }}" alt="{{ __($artifact->type) }}" class="text-fuse-teal-dk-500"/>
</div>
