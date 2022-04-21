@props(['name', 'label', 'required' => false])

<div class="mb-6">
    <label class="text-base"for="{{ $name }}">
        <span class="text-gray-700 form-required">{{ $label }}</span>
        @if ($required)
            <span class="form-required" title="This field is required.">*</span>
        @endif
    </label>
    <input type="text" id="{{ $name }}" name="{{ $name }}" @if ($required)
    required
    @endif
    class="form-input form-text-required mt-1 block w-full rounded"
    {{ $attributes(['value' => old($name)]) }}>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
