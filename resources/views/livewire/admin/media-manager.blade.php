<div>
    <x-slot name="title">{{ __('Media') }}</x-slot>

    <x-slot name="header">{{ __('Media') }}</x-slot>

    {{-- <livewire:toggle label="{{ __('Images Only') }}" event="toggleImages" > --}}
    {{-- @if ($onlyImages)
    only images
    @else
    everything
    @endif --}}
    {{-- <h3>{{ $query }}</h3> --}}
    {{-- <h2>
        Disk: <button>Public</button> |
        <button wire:click="setFSDisk('artifacts')">User Artifacts</button>
    </h2> --}}
    <h3>Current Location: {{ $fsdisk }}::<span wire:click="navigateBack(-1)" class="cursor-pointer">&lt;root&gt;</span>
    @foreach ($currentLocationArray as $k => $folder)
        /
        @if (! $loop->last)
        <span wire:click="navigateBack({{ $k }})" class="cursor-pointer">
        @endif
        {{ $folder }}
        @if (! $loop->last)
        </span>
        @endif
        @endforeach
        <div wire:loading wire:target='navigateBack, navigateForward'>(NAVIGATING...)</div>
    </h3>
    <button wire:click="refresh" class="btn">Refresh files <div wire:loading wire:target="refresh">(Working...)</div></button>
    <form wire:submit.prevent="makeSubdir">
        <fieldset class="border-black border p-2 max-h-64 overflow-y-scroll pt-0">
            <legend>Subdirectories</legend>
            <label class="flex items-center gap-2 border border-black rounded-lg px-2">
                <span>New Subdirectory</span>
                <input type="text" wire:model="newSubdir" placeholder="subdirectory name" class="w-1/2">
                <button type="submit">Create</button>
            </label>
            @foreach ($subdirectories as $k => $subdirectory)
            <span wire:click="navigateForward({{ $k }})" class="p-2 m-1 inline-block rounded-lg bg-fuse-teal-dk text-white hover:bg-fuse-teal cursor-pointer">{{ $subdirectory }}</span>
            @endforeach
        </fieldset>
    </form>
    <input wire:model.debounce.300ms="fileSearch" type="text" placeholder="{{ __('Filter by filename') }}">
    <form wire:submit.prevent="upload"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
    <label>Upload File:
    <input type="file" wire:model="fileToUpload">
    </label>
    <button type="submit">Upload File to {{ $fsdisk }}::{{ $currentLocation }} <div wire:loading wire:target="fileToUpload">...UPLOADING...</div></button>
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
    </form>
    <table class="border">
        <tr>
            <th>Media ID</th>
            <th>Thumbnail</th>
            <th>Name</th>
            <th>Alt Text</th>
            <th>Size (B)</th>
            <th>Last Modified</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($files as $file)
        <tr>
            <td>
            {{ $file->id }}
            </td>
            <td>
                @if ($file->aggregate_type == 'image')
                <a href="{{ $file->getUrl() }}">
                    <img src="{{ $file->getUrl() }}" class="w-12 h-12">
                </a>
                @endif
            </td>
            <td>
                <a href="{{ $file->getUrl() }}">
                    {{ $file->filename . '.' . $file->extension }}
                </a>
            </td>
            <td>
                {{ $file->alt }}
            </td>
            <td>
                {{ $file->size }}
            </td>
            <td>
                {{ $file->updated_at }}
            </td>
            <td>
                <div wire:click="editModal({{ $file->id }})"><x-icon icon="edit" /></div>
            </td>
            <td>
                <div wire:click="deleteModal({{ $file->id }})"><x-icon icon="trash" /></div>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $files->links() }}

    <x-jet-dialog-modal wire:model="showFileEditModal">
        <x-slot name="title">
            Edit {{ $targetFileFilename }}.{{ $targetFileExtension }}
        </x-slot>

        <x-slot name="content">
            <label>Alt text:
                <x-jet-input wire:model="targetFileAltText" class="inline border border-black"/>
            </label>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
                wire:click="$toggle('showFileEditModal')"
                wire:loading.attr="disabled"
                class="hover:bg-neutral-400">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="saveEdits" wire:loading.attr="disabled">
                Save Changes
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="showFileDeleteModal">
        <x-slot name="title">
            Delete "{{ $targetFileFilename }}.{{ $targetFileExtension }}"
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this file? This is an unrecoverable act.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showFileDeleteModal')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                Delete File
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</div>
