<div class="mt-4">
    <form>
    <select name="locale" id="locale" wire:model="activeLocale" wire:change="setLocale">
    @foreach ($locales as $name => $locale)
    <option value="{{ $locale }}">
            {{ $name }}
        </option>
    @endforeach
    </select>
</div>
