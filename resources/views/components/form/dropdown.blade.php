@props(['name', 'label', 'list', 'value', 'required' => false, 'none_label' => ''])

<div class="mb-6">
    <span class="text-gray-700 mb-2">{{ $label }}</span>
    @if ($required)
            <span class="form-required" title="This field is required.">*</span>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->merge(['class' => 'mt-1 block w-full rounded']) !!}>
        <option value="">{{ $none_label }}</option>
        @foreach ($list as $item)
            <option value="{{ $item->id }}" @if ($item->id == $value) selected @endif> {{ $item->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
