@props(['name', 'required' => false])

<div class="mb-6">
  <label class="block" for="{{ $name }}">
    <span class="text-gray-700">{{ ucwords($name) }}</span>
    @if ($required)
    <span class="form-required" title="This field is required.">*</span>
    @endif
  </label>
  <textarea class="form-textarea mt-1 block w-full rounded"
            id="{{ $name }}"
            name="{{ $name }}"
            @if ($required)
            required
            @endif
            {{ $attributes }}
            rows="3"
  >{{ $slot ?? old($name) }}</textarea>
  @error($name)
  <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
  @enderror
</div>
