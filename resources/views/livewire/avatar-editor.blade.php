<x-jet-form-section submit="saveAvatar">
        <x-slot name="title">
        <img class="mx-auto w-1/2 md:w-full lg:w-3/4 xl:w-1/2" src="{{ $previewAvatarUrl }}" alt="{{ __('8-bit cartoon of human head') }}">
            {{ __('Profile Picture') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Customize your profile picture.') }}
        </x-slot>

        <x-slot name="form">
        <div class="col-span-6 max-h-96 overflow-y-scroll">
        <div class="grid grid-cols-3 gap-2 mb-1">
            <div class="text-right">
                <div class="text-sm">{{ __('Background Color Picker:') }}</div>
                <input wire:model="backgroundColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
            </div>
            <div class="col-span-2">
                <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                    <legend class="text-sm">{{ __('Presets:')}}</legend>
                    @foreach ($backgroundColorOptions as $color)
                        <label class="m-0">
                            <input type="radio" wire:model="backgroundColor" value="{{ $color }}" class="hidden"/>
                            <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2 mb-1">
            <div class="text-right">
                <div class="text-sm">{{ __('Skin Color Picker:') }}</div>
                <input wire:model="skinColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
            </div>
            <div class="col-span-2">
                <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                    <legend class="text-sm">{{ __('Presets:')}}</legend>
                    @foreach ($skinColorOptions as $color)
                        <label class="m-0">
                            <input type="radio" wire:model="skinColor" value="{{ $color }}" class="hidden"/>
                            <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>
        </div>

        <div class="lg:grid grid-cols-2 gap-2">
        <fieldset class="border-neutral-700 border p-4 grid grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-1">
            <legend>{{ __('Eyes') }}</legend>
            @foreach ($eyesOptions as $eye)
                <label class="whitespace-nowrap">
                    <input wire:model="eyes" type="radio" value="{{ $eye['value'] }}">
                    {{ $eye['label'] }}
                </label>
            @endforeach
        </fieldset>

        <fieldset class="border-neutral-700 border p-4 grid grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-1">
            <legend>{{ __('Eyebrows') }}</legend>
            @foreach ($eyebrowsOptions as $eyebrow)
                <label class="whitespace-nowrap">
                    <input wire:model="eyebrows" type="radio" value="{{ $eyebrow['value'] }}">
                    {{ $eyebrow['label'] }}
                </label>
            @endforeach
        </fieldset>
        </div>

        <fieldset class="border-neutral-700 border p-2">
            <legend>{{ __('Mouth') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="mouthColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($mouthColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="mouthColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($mouthOptions as $mouth)
                    <label class="whitespace-nowrap">
                        <input wire:model="mouth" type="radio" value="{{ $mouth['value'] }}">
                        {{ $mouth['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-2">
            <legend>{{ __('Hair') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="hairColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($hairColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="hairColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($hairOptions as $hair)
                    <label class="whitespace-nowrap">
                        <input wire:model="hair" type="radio" value="{{ $hair['value'] }}">
                        {{ $hair['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-4">
            <legend>{{ __('Clothing') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="clothesColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($clothesColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="clothesColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($clothingOptions as $clothing)
                    <label class="whitespace-nowrap">
                        <input wire:model="clothing" type="radio" value="{{ $clothing['value'] }}">
                        {{ $clothing['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-4">
            <legend>{{ __('Hat') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="hatColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($hatColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="hatColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($hatOptions as $hat)
                    <label class="whitespace-nowrap">
                        <input wire:model="hat" type="radio" value="{{ $hat['value'] }}">
                        {{ $hat['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-4">
            <legend>{{ __('Glasses') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="glassesColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($glassesColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="glassesColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($glassesOptions as $glasses)
                    <label class="whitespace-nowrap">
                        <input wire:model="glasses" type="radio" value="{{ $glasses['value'] }}">
                        {{ $glasses['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-4">
            <legend>{{ __('Earrings') }}</legend>
            <div class="grid grid-cols-3 gap-2 mb-1">
                <div class="text-right">
                    <div class="text-sm">{{ __('Color Picker:') }}</div>
                    <input wire:model="accessoriesColor" type="color" class="inline-block h-8 w-10 cursor-crosshair">
                </div>
                <div class="col-span-2">
                    <fieldset class="inline-block border border-neutral-700 rounded-xl p-2 pt-0">
                        <legend class="text-sm">{{ __('Presets:')}}</legend>
                        @foreach ($accessoriesColorOptions as $color)
                            <label class="m-0">
                                <input type="radio" wire:model="accessoriesColor" value="{{ $color }}" class="hidden"/>
                                <span class="w-6 h-6 inline-block cursor-pointer" style="background-color:{{ $color }}">&nbsp;</span>
                            </label>
                        @endforeach
                    </fieldset>
                </div>
            </div>
            <div class="grid grid-cols-4 xl:grid-cols-5 gap-1">
                @foreach ($accessoryOptions as $accessory)
                    <label class="whitespace-nowrap">
                        <input wire:model="accessories" type="radio" value="{{ $accessory['value'] }}">
                        {{ $accessory['label'] }}
                    </label>
                @endforeach
            </div>
        </fieldset>

        <fieldset class="border-neutral-700 border p-4 grid grid-cols-4">
            <legend>{{ __('Beard') }}</legend>
            @foreach ($beardOptions as $beard)
                <label class="whitespace-nowrap">
                    <input wire:model="beard" type="radio" value="{{ $beard['value'] }}">
                    {{ $beard['label'] }}
                </label>
            @endforeach
        </fieldset>
        </div>

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="previewAvatarUrl">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>

</x-jet-form-section>
