<x-app-layout>

    <x-slot name="title">{{ __('Public Files') }}</x-slot>

    <x-slot name="header">{{ __('Public Files') }}</x-slot>

    <h2>{{ __('Public Files') }}</h2>

    <div>
        {{ __(':filecount files total', ['filecount' => $files->total()]) }}
    </div>
    <table class="border">
        <tr>
            <th>Name</th>
            <th>Path</th>
            <th>Size (B)</th>
            <th>Last Modified</th>
            <th>url</th>
        </tr>
        @foreach ($s3_files as $name => $attr)
        <tr>
            <td>
                <a href="{{ $attr['url'] }}">
                    {{ $name }}
                </a>
            </td>
            <td>
                {{ $attr['path'] }}
            </td>
            <td>
                {{ $attr['size'] }}
            </td>
            <td>
                {{ $attr['lastModified'] }}
            </td>
            <td>
                {{ $attr['url'] }}
            </td>
        </tr>
        @endforeach
    </table>
    <ul>
        @foreach ($files as $file)
        <li>
            {{ $file->filename }}
        </li>
        @endforeach
    </ul>

    {{ $files->links() }}

</x-app-layout>