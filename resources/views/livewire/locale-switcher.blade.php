<div class="mt-4">
    <form>
        <label for="locale" class="sr-only">{{ __('Language') }}</label>
        <div class="select-wcag-wrapper">
          <select name="locale" id="locale" wire:model="activeLocale" wire:change="setLocale">
            @foreach ($locales as $name => $locale)
            <option value="{{ $locale }}">
            {{ $name }}
            </option>
            @endforeach
          </select>
        </div>
    </form>
</div>
