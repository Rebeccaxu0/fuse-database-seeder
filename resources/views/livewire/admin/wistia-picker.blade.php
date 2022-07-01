@pushOnce('scripts')
    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
@endPushOnce

<div class="flex">
    <label class="flex-1">
        <span class="text-base text-gray-700 mb-2">{{ $label }}</span>
        <input wire:model.debounce.500ms="wistiaId"
               name="{{ $name }}"
               class="rounded"
               placeholder="{{ __('Wistia Code') }}"
               type="text">
        @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </label>
    @if ($thumbnail)
    <div class="flex-1 px-4">
        <img src="{{ $thumbnail }}">
    </div>
    @endif
</div>
