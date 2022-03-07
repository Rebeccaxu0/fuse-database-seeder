@props(['name', 'inherited', 'label', 'list', 'value'])

<div class="mb-6">
    <span class="text-gray-700 mb-2 form-required">{{ $label }}</span>
    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->merge(['class' => 'mt-1 block w-full rounded']) !!}>
        @foreach ($list as $item)
            <option value="{{ $item->id }}" @if ($item->id == $value) selected @endif> {{ $item->name }}
            </option>
        @endforeach
        @if ($inherited)
            <option value="{{ $inherited->id }}" @if ($inherited->id == $value) selected @endif>
                {{ __('Inherited: :name', ['name' => $inherited->name]) }}
            </option>
        @endif
    </select>
</div>