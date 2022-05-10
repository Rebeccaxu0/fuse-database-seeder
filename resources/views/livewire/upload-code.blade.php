<div>
    <label class="pt-0" for="uploadcode">{{ ('Mobile Upload Code') }}</label>
    @error('uploadcode')
    <span class="alert">{{ $message }}</span>
    @enderror
    <input wire:model="uploadCode" id="uploadcode"
           name="uploadcode"
           placeholder="{{ ('e.g. ABC123') }}"
           value="{{ old('uploadcode') }}"
           class="px-1 placeholder-gray-300"
           {{-- @error('uploadcode') border border-red-500 @enderror --}}
           @if ($disabled) disabled @endif
           >
</div>
