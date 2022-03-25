<svg
    xmlns="http://www.w3.org/2000/svg"
    width="{{ $width }}"
    height="{{ $height }}"
    viewBox="0 0 {{ $viewBox }}"
    fill="{{ $fill }}"
    stroke="currentColor"
    stroke-width="{{ $strokeWidth }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => "$icon $class", 'inline-block' => ! $displayOverride]) }}
>
    @includeIf("icons.$icon")
</svg>

