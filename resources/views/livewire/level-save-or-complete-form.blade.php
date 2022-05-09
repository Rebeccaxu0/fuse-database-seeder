<form method="POST"
      action="{{ route('student.save_artifact') }}"
      class="bg-slate-100 rounded-xl p-2">
    @csrf
    <button id="close-btn" class="float-right"><x-icon icon="x-circle" /></button>
    <input type="hidden" id="lid" name="lid" value="{{ $level_id }}" />
    @error('lid')
    <div class="alert">{{ $message }}</div>
    @enderror
    <input type="hidden" id="uid" name="uid" value="{{ auth()->user()->id }}" />
    @error('uid')
    <div class="alert">{{ $message }}</div>
    @enderror
    <div class="w-full my-2">
        <div x-init="$el.remove()" id="js_notice" class="text-red-500" >
            {{ __('Javascript required for file upload.') }}
        </div>
        @if ($previewUrl)
        <div class="flex flex-col items-center">
            <img src="{!! $previewUrl !!}" />
            <button wire:click.prevent="removePreview">{{ __('Remove') }}</button>
        </div>
        @endif
        <livewire:filestack-picker />
        @error('file')
            <div class="alert">{{ $message }}</div>
        @enderror
        <livewire:upload-code />
        <label class="pt-0" for="url">{{ __('URL') }}</label>
        @error('url')
            <div class="alert">{{ $message }}</div>
        @enderror
        <input wire:model.debounce.750ms="url"
               id="url"
               name="url"
               placeholder="{{ __('e.g. https://www.duckduckgo.com') }}"
               value="{{ old('url') }}"
               class="px-1 @error('url') border border-red-500 @enderror placeholder-gray-300"
               @if ($urlDisabled) disabled @endif
               />
    </div>
    <label for="name" class="p-0">{{ ('Name (optional)') }}</label>
    @error('name')
        <div class="alert">{{ $message }}</div>
    @enderror
    <input id="name"
           name="name"
           placeholder="{{ __('Name your artifact if you want') }}"
           value="{{ old('name') }}"
           class="px-1 @error('name') border border-red-500 @enderror placeholder-gray-300"
           />
    @error('name')
        <div class="alert">{{ $message }}</div>
    @enderror
    <livewire:artifact-teammates :user="auth()->user()"/>
    <label for="notes" class="p-0">{{ ('Notes (optional)') }}</label>
    @error('notes')
        <div class="alert">{{ $message }}</div>
    @enderror
    <textarea id="notes"
              name="notes"
              class="block w-full @error('notes') border border-red-500 @enderror"
              >{{ old('notes') }}</textarea>
    @error('type')
        <div class="alert">{{ $message }}</div>
    @enderror
    <input type="radio" id="save_type" name="type" value="save" checked />
    <label for="save_type" class="p-0">{{ __("I'm just saving") }}</label>
    <input type="radio" id="complete_type" name="type" value="complete" />
    <label for="complete_type" class="p-0">{{ __("I'm completing") }}</label>
    <div class="text-right">
        <button class="btn bg-fuse-green text-white uppercase">{{ __('Submit') }}</button>
    </div>
</form>

