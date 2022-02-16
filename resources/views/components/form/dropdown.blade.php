@props(['name', 'label', 'list', 'value'])

<div class="mb-6">
    <label class="text-gray-700 mb-2 form-required">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->merge(['class' => 'mt-1 block w-full rounded']) !!}>
        <option> </option>
        @foreach ($list as $item)
        <option value="{{ $item->id }}" @if ($item->id == $value) selected @endif>{{ $item->name }}</option>
        @endforeach
    </select>
</div>
