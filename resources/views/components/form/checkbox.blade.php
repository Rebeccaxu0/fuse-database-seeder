@props(['name', 'checked', 'required' => false, 'label' => str_replace('_', ' ', $name)])

<div class="mb-6">
    <input type="checkbox" class="form-checkbox" id="{{ $name }}" name="{{ $name }}"
        {{ $checked ? 'checked' : '' }}>
    <label for="{{ $name }}" class="font-semibold">
        <span class="mx-2 text-gray-700">{{ ucwords($label) }}</span>
    </label>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
