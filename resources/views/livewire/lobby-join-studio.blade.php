<div>
    <form wire:submit.prevent="submit">
                <label class="text-xl " for="studio_code">{{ __('Studio Code') }}</label>
                <input
                    type="text"
                    name="studio_code"
                    id="studio_code"
                    placeholder="{{ __('e.g. White Wolf 123') }}"
                    wire:model="studioCode" />
                @error('studioCode')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror
                <button type="submit"> Join </button>
    </form>
</div>