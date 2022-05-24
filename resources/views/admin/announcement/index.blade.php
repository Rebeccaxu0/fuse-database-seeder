<x-app-layout>
    <x-slot name="title">{{ __('Announcements') }}</x-slot>

    <x-slot name="header">{{ __('Announcements') }}</x-slot>

    <a href="{{ route('admin.announcements.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Make new Announcement</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Details') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
            <tr>
                <td class="announcement-tag {{ $announcement->type }}">{{ $announcement->type }}</td>
                <td>
                    <div>
                        <span class="font-bold">{{ __('Start:') }}</span> {{ $announcement->start_at }}
                    </div>
                    <div>
                        <span class="font-bold">{{ __('End:') }}</span> {{ $announcement->end_at }}
                    </div>
                    <div>
                        <span class="font-bold">{{ __('Link:') }}</span> {{ $announcement->url ? $announcement->url : __('<none>') }}
                    </div>
                    <div>
                        <span class="font-bold">{{ __('Message:') }}</span> {{ $announcement->body }}
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

