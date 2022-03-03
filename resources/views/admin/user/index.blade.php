<x-app-layout>
    @foreach ($users as $user)
    <div>
      {{ $user->name }}
      @if (Cache::has('user-is-online-' . $user->id))
      Online
      @else
      Offline
      @endif
    </div>
    @endforeach

    {{ $users->links() }}
</x-app-layout>