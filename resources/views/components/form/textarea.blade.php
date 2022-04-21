@props(['name', 'sublabel', 'required' => false])

<div class="mb-6">
    <label class="text-base" for="{{ $name }}">
        <span class="text-gray-700">{{ ucwords($name) }}</span>
        @if ($required)
            <span class="form-required" title="This field is required.">*</span>
        @endif
    </label>
    <p class="text-gray-700 text-xs mt-1">{{ $sublabel }}</p>
    <textarea class="form-textarea block w-full rounded" id="{{ $name }}" name="{{ $name }}"
        @if ($required)
            required
            @endif
            {{ $attributes }}
            rows="2"
  >{{ $slot ?? old($name) }}</textarea>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
