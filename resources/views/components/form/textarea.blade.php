@props(['label', 'name', 'sublabel' => false, 'required' => false, 'value' => ''])

<div class="mb-6">
    <label class="text-base" for="{{ $name }}">
        <span class="text-gray-700">{{ $label }}</span>
        @if ($required)
            <span class="form-required" title="This field is required.">*</span>
        @endif
    @if ($sublabel)
    <p class="text-gray-700 text-xs mt-1">{{ $sublabel }}</p>
    @endif
    <textarea class="form-textarea block w-full rounded" id="{{ $name }}" name="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes }}
        rows="3"
  >{{ $value }}</textarea>
    </label>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
