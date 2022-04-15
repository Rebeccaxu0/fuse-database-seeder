<div>
  <label for="uploadcode">{{ ('Mobile Upload Code') }}</label>
  @error('uploadcode')
  <div class="alert">{{ $message }}</div>
  @enderror
  <input id="uploadcode"
         name="uploadcode"
         placeholder="{{ ('e.g. ABC123') }}"
         value="{{ old('uploadcode') }}"
         class="px-1 @error('uploadcode') border border-red-500 @enderror"
         >
</div>
