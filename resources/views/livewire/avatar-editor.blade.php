<div>
    <div class="float-left w-64 h-64 mr-4 mb-4">
        <img src="{{ $api_url }}{{ urlencode($seed) }}.svg?b={{ urlencode($bgColor) }}&radius=50&{{ $beard }}&eyes[]={{ $eyes }}&eyebrows[]={{ $eyebrows }}&mouth[]={{ $mouth }}&{{ $hair }}&skinColor[]={{ urlencode($skinColor) }}&hairColor[]={{ urlencode($hairColor) }}&clothesColor[]={{ urlencode($clothesColor) }}&glassesColor[]={{ urlencode($glassesColor) }}&mouthColor[]={{ urlencode($mouthColor) }}&hatColor[]={{ urlencode($hatColor) }}">
    </div>
    <details>
        <summary>{{ __('Edit Your Profile Picture') }}</summary>
    <fieldset class="border border-neutral-700 px-4 pb-4 grid grid-cols-2 gap-4">
        <legend>{{ __('Colors') }}</legend>
        <label>{{ __('Background') }}
            <input wire:model="bgColor" type="color">
        </label>
        <label>{{ __('Hair') }}
            <input wire:model="hairColor" type="color">
        </label>
        <label>{{ __('Mouth') }}
            <input wire:model="mouthColor" type="color">
        </label>
        <label>{{ __('Accessories') }}
            <input wire:model="AccessoriesColor" type="color">
        </label>
        <label>{{ __('Clothes') }}
            <input wire:model="clothesColor" type="color">
        </label>
        <label>{{ __('Hat') }}
            <input wire:model="hatColor" type="color">
        </label>
        <label>{{ __('Glasses') }}
            <input wire:model="glassesColor" type="color">
        </label>
    </fieldset>
    <fieldset class="border-neutral-700 border p-4">
        <legend>{{ __('Eyes') }}</legend>
        <label>
            <input wire:model="eyes" type="radio" value="variant01">
            {{ __('Type 1') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant02">
            {{ __('Type 2') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant03">
            {{ __('Type 3') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant04">
            {{ __('Type 4') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant05">
            {{ __('Type 5') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant06">
            {{ __('Type 6') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant07">
            {{ __('Type 7') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant08">
            {{ __('Type 8') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant09">
            {{ __('Type 9') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant10">
            {{ __('Type 10') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant11">
            {{ __('Type 11') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant12">
            {{ __('Type 12') }}
        </label>
        <label>
            <input wire:model="eyes" type="radio" value="variant13">
            {{ __('Type 13') }}
        </label>
    </fieldset>
    <fieldset class="border-neutral-700 border p-4">
        <legend>{{ __('Eyebrows') }}</legend>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant01">
            {{ __('Type 1') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant02">
            {{ __('Type 2') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant03">
            {{ __('Type 3') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant04">
            {{ __('Type 4') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant05">
            {{ __('Type 5') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant06">
            {{ __('Type 6') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant07">
            {{ __('Type 7') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant08">
            {{ __('Type 8') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant09">
            {{ __('Type 9') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant10">
            {{ __('Type 10') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant11">
            {{ __('Type 11') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant12">
            {{ __('Type 12') }}
        </label>
        <label>
            <input wire:model="eyebrows" type="radio" value="variant13">
            {{ __('Type 13') }}
        </label>
    </fieldset>
    <fieldset class="border-neutral-700 border p-2 md:flex gap-2">
        <legend>{{ __('Mouth') }}</legend>
        <fieldset class="border border-neutral-500 p-2">
            <legend>{{ __('Happy') }}</legend>
            <label>
                <input wire:model="mouth" type="radio" value="happy01">
                {{ __('Happy 1') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy02">
                {{ __('Happy 2') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy03">
                {{ __('Happy 3') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy04">
                {{ __('Happy 4') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy05">
                {{ __('Happy 5') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy06">
                {{ __('Happy 6') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy07">
                {{ __('Happy 7') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy08">
                {{ __('Happy 8') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="happy09">
                {{ __('Happy 9') }}
            </label>
        </fieldset>
        <fieldset class="border border-neutral-500 p-2">
            <legend>{{ __('Sad') }}</legend>
            <label>
                <input wire:model="mouth" type="radio" value="sad01">
                {{ __('Sad 1') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad02">
                {{ __('Sad 2') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad03">
                {{ __('Sad 3') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad04">
                {{ __('Sad 4') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad05">
                {{ __('Sad 5') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad06">
                {{ __('Sad 6') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad07">
                {{ __('Sad 7') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="sad08">
                {{ __('Sad 8') }}
            </label>
        </fieldset>
        <fieldset class="border border-neutral-500 p-2">
            <legend>{{ __('Surprised') }}</legend>
            <label>
                <input wire:model="mouth" type="radio" value="surprised01">
                {{ __('Surprised 1') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="surprised02">
                {{ __('Surprised 2') }}
            </label>
            <label>
                <input wire:model="mouth" type="radio" value="surprised03">
                {{ __('Surprised 3') }}
            </label>
        </fieldset>
    </fieldset>
    <fieldset class="border-neutral-700 border p-2">
        <legend>{{ __('Hair') }}</legend>
        <div class="md:flex gap-2">
        <fieldset class="border border-neutral-500 p-2">
            <legend>{{ __('Short') }}</legend>
            <label>
                <input wire:model="hairType" type="radio" value="short01">
                {{ __('Type 1') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short02">
                {{ __('Type 2') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short03">
                {{ __('Type 3') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short04">
                {{ __('Type 4') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short05">
                {{ __('Type 5') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short06">
                {{ __('Type 6') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short07">
                {{ __('Type 7') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short08">
                {{ __('Type 8') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short09">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short10">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="short11">
                {{ __('Type 9') }}
            </label>
        </fieldset>
        <fieldset class="border border-neutral-500 p-2">
            <legend>{{ __('Long') }}</legend>
            <label>
                <input wire:model="hairType" type="radio" value="long01">
                {{ __('Type 1') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long02">
                {{ __('Type 2') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long03">
                {{ __('Type 3') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long04">
                {{ __('Type 4') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long05">
                {{ __('Type 5') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long06">
                {{ __('Type 6') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long07">
                {{ __('Type 7') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long08">
                {{ __('Type 8') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long09">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long10">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long11">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long12">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long13">
                {{ __('Type 9') }}
            </label>
            <label>
                <input wire:model="hairType" type="radio" value="long14">
                {{ __('Type 9') }}
            </label>
        </fieldset>
    </div>
        <label>
            <input wire:model="hairType" type="radio" value="none">
            {{ __('None') }}
        </label>
    </fieldset>
    <fieldset class="border-neutral-700 border p-4">
        <legend>{{ __('Beard') }}</legend>
        <label>
            <input wire:model="beard" type="radio" value="beardProbability=0">
            {{ __('No Beard') }}
        </label>
        <label>
            <input wire:model="beard" type="radio" value="beardProbability=100&beard[]=variant01">
            {{ __('Type 1') }}
        </label>
        <label>
            <input wire:model="beard" type="radio" value="beardProbability=100&beard[]=variant02">
            {{ __('Type 2') }}
        </label>
        <label>
            <input wire:model="beard" type="radio" value="beardProbability=100&beard[]=variant03">
            {{ __('Type 3') }}
        </label>
        <label>
            <input wire:model="beard" type="radio" value="beardProbability=100&beard[]=variant04">
            {{ __('Type 4') }}
        </label>
    </fieldset>
    </details>
</div>
