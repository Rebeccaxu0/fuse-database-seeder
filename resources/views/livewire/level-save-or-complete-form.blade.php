<form x-cloak x-data="{ previewOpen: @entangle('previewOpen') }"
    wire:submit.prevent="makeArtifact" class="relative bg-neutral-100 rounded-xl p-2 pt-7">
    @csrf
    <div x-init="$el.remove()" id="js_notice" class="text-red-500" >
        {{ __('Javascript required') }}
    </div>
    <a class="absolute right-0 cursor-pointer -mt-6 mr-1"
       @click="saveCompleteFormOpen = false"
       ><x-icon icon="x-circle" /></a>
    <input type="hidden" id="lid" name="lid" value="{{ $lid }}" />
    @error('lid')
    <div class="alert text-sm">{{ $message }}</div>
    @enderror
    <div class="grid gap-4 grid-cols-1 2xl:grid-cols-1">
        <div class="overflow-hidden" style="min-width: 400px">
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
                    <label for="artifactName" class="p-0">{{ __('Name (optional)') }}</label>
                    @error('artifactName')
                    <span class="alert text-sm">{{ $message }}</span>
                    @enderror
                    <input wire:model="artifactName"
                        placeholder="{{ __('Rename your artifact if you want') }}"
                        class="px-1 h-12 border mb-4 @error('artifactName') border-red-500 @else border-neutral-600 @enderror placeholder-gray-300"
                        />
                </div>
                @error('name')
                <div class="alert text-sm">{{ $message }}</div>
                @enderror
            </div>
            <livewire:filestack-picker />
            @error('file')
                <div class="alert text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="pt-0" for="uploadcode">{{ __('Mobile Upload Code') }} (<a target="_blank" href="https://up.fusestudio.net">up.fusestudio.net</a>) <livewire:help-modal helpArticleId="738" linkText="<span title='info' class='border text-fuse-teal-500 border-fuse-teal-500 rounded-xl inline-block h-6 w-6 text-center'>i</span>" /></label>
            @error('uploadCode')
            <span class="alert text-sm">{{ $message }}</span>
            @enderror
            <input wire:model.debounce.500ms="uploadCode"
                id="uploadCode"
                placeholder="{{ __('e.g. ABC123') }}"
                value="{{ old('uploadCode') }}"
                class="px-1 placeholder-gray-300 h-12 border @error('uploadCode') border-red-500 @else border-neutral-600 @enderror mb-4"
                
                @if ($uploadCodeDisabled) disabled @endif
                />
            @if (! $urlDisappear)
            <label class="pt-0" for="url">{{ __('URL') }}</label>
            @error('url')
            <span class="alert text-sm">{{ $message }}</span>
            @enderror
            <input wire:model.debounce.750ms="url"
                id="url"
                name="url"
                placeholder="{{ __('e.g. https://www.duckduckgo.com') }}"
                value="{{ old('url') }}"
                class="px-1 placeholder-gray-300 h-12 border border-neutral-600 mb-4"
                {{-- @error('url') border border-red-500 @enderror --}}
                @if ($urlDisabled) disabled @endif
                />
            @endif
            @if ($studioMembers->count())
            <div>
                <label class="p-0">{{ __('I worked with') }}</label>
                @foreach ($teamNames as $name)
                <span class='bg-white border rounded px-1 mx-1 text-sm whitespace-nowrap'>
                    {{ $name }}
                </span>
                @endforeach
                <div class="grid gap-2 md:grid-cols-2 max-h-16 p-2 bg-white border border-neutral-600 rounded-md overflow-y-scroll mb-4">
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
            @endif
            <label for="notes" class="p-0">{{ __('Notes (optional)') }}</label>
            @error('notes')
                <div class="alert text-sm">{{ $message }}</div>
            @enderror
            <textarea wire:model="notes" id="notes"
                    name="notes"
                    class="block w-full border rounded-md mb-4 @error('notes') border-red-500 @enderror"
                    ></textarea>
            @error('type')
            @enderror
        </div>
    </div>
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert">{{ $error }}</div>
        @endforeach
    @enderror --}}
    <div class="text-right">
        <button class="btn text-white uppercase">{{ __('Submit :type', ['type' => $type]) }}</button>
    </div>
</form>
