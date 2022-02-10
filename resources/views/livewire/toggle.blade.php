<div wire:click="toggle" class="cursor-pointer flex items-center">
    <div class="inline-block rounded-2xl p-0.5 w-14 h-7 @if ($is_active) bg-green-500 @else bg-gray-400 @endif transition">
        <div class="bg-white rounded-xl w-6 h-6 transition @if ($is_active) ml-7 @endif"></div>
    </div>
    <div class="inline-block font-bold ml-2">{{ $label }}</div>
</div>
