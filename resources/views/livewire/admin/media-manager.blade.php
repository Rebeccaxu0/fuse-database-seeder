<div>
    <x-slot name="title">{{ __('Media') }}</x-slot>

    <x-slot name="header">{{ __('Media') }}</x-slot>

    <livewire:toggle label="{{ __('Images Only') }}" event="toggleImages" >
    @if ($onlyImages)
    only images
    @else
    everything
    @endif
    {{-- <h3>{{ $query }}</h3> --}}
    <details>
        <summary>
            <input class="inline-block" type="text" wire:model="current_dir" placeholder="{{ __('Current Directory') }}">
        </summary>
        <ul>
            @foreach ($directories as $directory)
            <li class="p-0 m-0">{{ $directory->directory }}</li>
            @endforeach
        </ul>
    </details>
    <input wire:model.debounce.300ms="fileSearch" type="text" placeholder="{{ __('Filter by filename') }}">
    <table class="border">
        <tr>
            <th>Thumbnail</th>
            <th>Name</th>
            <th>Size (B)</th>
            <th>Last Modified</th>
        </tr>
        @foreach ($files as $file)
        <tr>
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
                {{ $file->size }}
            </td>
            <td>
                {{ $file->updated_at }}
            </td>
        </tr>
        @endforeach
    </table>

    {{ $files->links() }}
</div>
