@props(['notes' => 'no notes yet'])
<div>
    {{ __('Studio Notes') }}
    <div class="border-solid border-black border-2">
        {{ $notes }}
    </div>
</div>
