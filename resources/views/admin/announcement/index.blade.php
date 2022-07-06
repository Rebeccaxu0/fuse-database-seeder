<x-app-layout>
    <x-slot name="title">Announcements</x-slot>

    <x-slot name="header">Announcements</x-slot>

    <a href="{{ route('admin.announcements.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Make new Announcement</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
            <tr>
                <td class="text-white announcement-tag {{ $announcement->type }}">{{ $announcement->type }}</td>
                <td>
                    <div>
                        <span class="font-bold">Start:</span> {{ $announcement->start_at }}
                    </div>
                    <div>
                        <span class="font-bold">End:</span> {{ $announcement->end_at }}
                    </div>
                    <div>
                        <span class="font-bold">Link:</span> @if ($announcement->url) {{ $announcement->url }} @else <none> @endif
                    </div>
                    <div>
                        <span class="font-bold">Message:</span> {{ $announcement->body }}
                <td>
                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}">
                        <button><x-icon icon="edit" width=25 height=25 class="ml-2 text-black" /></button>
                    </a>
                    <form method="post"
                          action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                          class="inline-block">
                          @method('delete')
                          @csrf
                          <button><x-icon icon="trash" width=25 height=25 class="ml-2 text-black" /></button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
</x-admin-layout>

