<x-app-layout>

    <x-slot name="title">{{ __('Media') }}</x-slot>

    <x-slot name="header">{{ __('Media') }}</x-slot>

    <h2>{{ __('Media') }}</h2>

    <a href="?dir=">Home</a>
    <h2 class="text-sm">{{ __('Current Dir:') }}<br><span class="italic">{{ $current_dir }}</span></h2>
    <h3 class="border m-0">{{ __('Subdirectories') }}</h3>
    <ul class="border mb-4 pl-8">
    @foreach ($directories as $directory)
    <li class="m-0 p-0"><a href="?dir={{ $directory }}">{{ $directory }}</a></li>
    @endforeach
    </ul>
    <table class="border">
        <tr>
            <th>Thumbnail</th>
            <th>Name</th>
            <th>Size (B)</th>
            <th>Last Modified</th>
        </tr>
        @foreach ($media as $file)
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
    {{-- <ul>
        @foreach ($files as $file)
        <li>
            <a href="{{ Storage::disk($file->disk)->url($file->filename) }}">
                {{ $file->filename }}
            </a>
        </li>
        @endforeach
    </ul> --}}

    {{ $media->links() }}

</x-app-layout>
