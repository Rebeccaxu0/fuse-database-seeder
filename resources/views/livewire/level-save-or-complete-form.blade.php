<form x-data="{ previewOpen: @entangle('previewOpen') }"
    wire:submit.prevent="makeArtifact" class="bg-slate-100 rounded-xl p-2">
    @csrf
    <div x-init="$el.remove()" id="js_notice" class="text-red-500" >
        {{ __('Javascript required') }}
    </div>
    <a class="float-right cursor-pointer"
       @click="saveCompleteFormOpen = false"
       ><x-icon icon="x-circle" /></a>
    <input type="hidden" id="lid" name="lid" value="{{ $lid }}" />
    @error('lid')
    <div class="alert">{{ $message }}</div>
    @enderror
    <div class="w-full mt-6 mb-2">
        <div x-show="previewOpen"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 scale-50"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-50"
             class="flex flex-col items-center">
            <div class="bg-fuse-teal-dk border border-white p-8">
                <img class="w-[100px]" src="{!! $previewUrl !!}" />
            </div>
            <div>{{ $previewName }}</div>
            <button class="btn" wire:click.prevent="removePreview">{{ __('Remove') }}</button>
            <div class="w-full">
                <label for="artifactName" class="p-0">{{ ('Name (optional)') }}</label>
                @error('artifactName')
                <span class="alert">{{ $message }}</span>
                @enderror
                <input wire:model="artifactName"
                       placeholder="{{ __('Rename your artifact if you want') }}"
                       class="px-1 @error('artifactName') border border-red-500 @enderror placeholder-gray-300"
                       />
            </div>
    @error('name')
        <div class="alert">{{ $message }}</div>
    @enderror
        </div>
        <livewire:filestack-picker />
        @error('file')
            <div class="alert">{{ $message }}</div>
        @enderror
        {{-- <livewire:upload-code /> --}}
    @if (! $uploadCodeDisappear)
        <label class="pt-0" for="uploadcode">{{ ('Mobile Upload Code') }}</label>
        @error('uploadCode')
        <span class="alert">{{ $message }}</span>
        @enderror
        <input wire:model.debounce.500ms="uploadCode"
               id="uploadCode"
               placeholder="{{ ('e.g. ABC123') }}"
               value="{{ old('uploadCode') }}"
               class="px-1 placeholder-gray-300"
               {{-- @error('uploadCode') border border-red-500 @enderror --}}
               @if ($uploadCodeDisabled) disabled @endif
               />
    @endif
    @if (! $urlDisappear)
        <label class="pt-0" for="url">{{ __('URL') }}</label>
        @error('url')
        <span class="alert">{{ $message }}</span>
        @enderror
        <input wire:model.debounce.750ms="url"
               id="url"
               name="url"
               placeholder="{{ __('e.g. https://www.duckduckgo.com') }}"
               value="{{ old('url') }}"
               class="px-1 placeholder-gray-300"
               {{-- @error('url') border border-red-500 @enderror --}}
               @if ($urlDisabled) disabled @endif
               />
    @endif
    </div>
    <div>
        {{ __('I worked with: ') }}
        @foreach ($teamNames as $name)
        <span class='bg-white border rounded px-1 mx-1'>
            {{ $name }}
        </span>
        @endforeach
        <div class="grid gap-2 md:grid-cols-2 max-h-16 overflow-y-scroll">
            @foreach ($studioMembers as $student)
            <div class="">
                <label class="p-0">
                    <input class="hidden" name="teammates[]" type="checkbox" wire:model="teammates" value="{{ $student->id }}"/>
                    <span>
                        {{ $student->full_name }} ({{ $student->name }})
                    </span>
                </label>
            </div>
            @endforeach
        </div>
    </div>
    <label for="notes" class="p-0">{{ ('Notes (optional)') }}</label>
    @error('notes')
        <div class="alert">{{ $message }}</div>
    @enderror
    <textarea wire:model="notes" id="notes"
              name="notes"
              class="block w-full @error('notes') border border-red-500 @enderror"
              ></textarea>
    @error('type')
    @enderror
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert">{{ $error }}</div>
        @endforeach
    @enderror
    <input wire:model="type" type="radio" id="save_type" name="type" value="save" checked />
    <label for="save_type" class="p-0">{{ __("I'm just saving") }}</label>
    <input wire:model="type" type="radio" id="complete_type" name="type" value="complete" />
    <label for="complete_type" class="p-0">{{ __("I'm completing") }}</label>
    <div class="text-right">
        <button class="btn bg-fuse-green text-white uppercase">{{ __('Submit') }}</button>
    </div>
</form>

