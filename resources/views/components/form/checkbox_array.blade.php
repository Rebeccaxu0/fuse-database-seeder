@props(['name', 'value', 'label', 'active' => null])

<div>
    <label class="p-0 m-0">
        <input type="checkbox"
               class="form-checkbox"
               id="{{ "{$name}-{$value}" }}"
               name="{{ $name }}[]"
               value="{{ $value }}"
               {{ (old($name) && in_array($value, old($name))) || $active ? 'checked' : '' }}>
        <span class="mx-2 text-gray-700">{{ $label }}</span>
    </label>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
