<x-app-layout>

    <x-slot name="title">{{ __('Public Files') }}</x-slot>

    <x-slot name="header">{{ __('Public Files') }}</x-slot>

    <h2>{{ __('Public Files') }}</h2>

    <div>
        {{-- __(':filecount files total', ['filecount' => $files->total()]) --}}
    </div>
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
            <th>Name</th>
            <th>Size (B)</th>
            <th>Last Modified</th>
        </tr>
        @foreach ($s3_files as $name => $attr)
        <tr>
            <td>
                <a href="{{ $attr['url'] }}">
                    {{ $name }}
                </a>
            </td>
            <td>
                {{ $attr['size'] }}
            </td>
            <td>
                {{ $attr['lastModified'] }}
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

    {{ $s3_files->links() }}

</x-app-layout>