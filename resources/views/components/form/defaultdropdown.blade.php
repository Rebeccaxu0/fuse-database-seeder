@props(['name', 'inherited', 'label', 'list', 'value'])

<div class="mb-6">
    <span class="text-gray-700 mb-2 form-required">{{ $label }}</span>
    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->merge(['class' => 'mt-1 block w-full rounded']) !!}>
        @if ($inherited)
            <option value="" @if (! $value) selected @endif>
                {{ __('Inherited: :name', ['name' => $inherited->name]) }}
            </option>
        @endif
        @foreach ($list as $item)
            <option value="{{ $item->id }}" @if ($item->id == $value) selected @endif> {{ $item->name }}
            </option>
        @endforeach
    </select>
</div>
