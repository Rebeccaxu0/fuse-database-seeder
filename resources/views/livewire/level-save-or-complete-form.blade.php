@push('scripts')
<script>
    document.getElementById('js_notice').hidden = true;
</script>
@endpush

<form method="POST"
      action="{{ route('student.save_artifact') }}"
      class="bg-slate-100 rounded-xl p-2">
    @csrf
    <button id="close-btn" class="float-right"><x-icon icon="x-circle" /></button>
    <input type="hidden" id="lid" name="lid" value="{{ $level_id }}">
    @error('lid')
    <div class="alert">{{ $message }}</div>
    @enderror
    <input type="hidden" id="uid" name="uid" value="{{ auth()->user()->id }}">
    @error('uid')
    <div class="alert">{{ $message }}</div>
    @enderror
    <div class="w-full my-2">
        <div id="js_notice" class="text-red-500">
            {{ __('Javascript required for file upload.') }}
        </div>
        @error('file')
            <div class="alert">{{ $message }}</div>
        @enderror
        <livewire:upload-code />
        <label for="url">{{ __('URL') }}</label>
        @error('url')
            <div class="alert">{{ $message }}</div>
        @enderror
        <input id="url"
               name="url"
               placeholder="{{ __('e.g. https://www.duckduckgo.com') }}"
               value="{{ old('url') }}"
               class="px-1 @error('url') border border-red-500 @enderror"
               >
    </div>
    <label for="name">{{ ('Name (optional)') }}</label>
    @error('name')
        <div class="alert">{{ $message }}</div>
    @enderror
    <input id="name"
           name="name"
           placeholder="{{ __('Name your artifact if you want') }}"
           value="{{ old('name') }}"
           class="px-1 @error('name') border border-red-500 @enderror"
           >
    @error('name')
        <div class="alert">{{ $message }}</div>
    @enderror
    <livewire:artifact-teammates :user="auth()->user()"/>
    <label for="notes">{{ ('Notes (optional)') }}</label>
    @error('notes')
        <div class="alert">{{ $message }}</div>
    @enderror
    <textarea id="notes"
              name="notes"
              class="block @error('notes') border border-red-500 @enderror"
              >{{ old('notes') }}</textarea>
    @error('type')
        <div class="alert">{{ $message }}</div>
    @enderror
    <input type="radio" id="save_type" name="type" value="save" checked>
    <label for="save_type">{{ __("I'm just saving") }}</label>
    <input type="radio" id="complete_type" name="type" value="complete">
    <label for="complete_type">{{ __("I'm completing") }}</label>
    <div class="text-right">
        <button class="btn bg-fuse-green text-white uppercase">{{ __('Submit') }}</button>
    </div>
</form>

