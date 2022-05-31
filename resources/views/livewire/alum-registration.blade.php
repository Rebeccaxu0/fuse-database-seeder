<div x-data="{ openJ: @entangle('showJoin').defer, openE: @entangle('showEmail').defer }" class="mt-6 grid grid-cols-1 gap-6 max-w-full">
    <x-slot name="title">{{ __('Lobby') }}</x-slot>
    <x-jet-validation-errors />
    <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Welcome back to FUSE!') }}</h1>
    <div>
        <form wire:submit.prevent="codecheck">
            <label class="text-lg" for="studio_code">{{ __('Studio Code') }}</label>
            <input type="text" name="studio_code" id="studio_code" placeholder="{{ __('e.g. White Wolf 123') }}" wire:model="studioCode" wire:keyup.debounce.300ms="codecheck" />
            @error('studioCode')
            <span class="text-red-500">
                {{ $message }}
            </span>
            @enderror
        <div x-show="openE">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"/>
        </div>
        <p x-show="openJ"> {{ $studioName }}  in {{ $school }} </p>
        <button type="submit" x-show="openJ" wire:click="join"> Join </button>
        </form>
    </div>
    </div>
    <a class="ml-6 underline" href="https://www.fusestudio.net/">My Stuff</a>
    <p class="rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
        <a class="ml-6 underline" href="https://www.fusestudio.net/">Free Trial</a>
        <a class="ml-6 underline" href="https://www.fusestudio.net/">Why Fuse?</a>
        <a class="ml-6 underline" href="https://www.fusestudio.net/">For Teachers</a>
    </p>
</div>