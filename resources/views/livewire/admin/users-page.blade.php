<div>
    <input wire:model.debounce.300ms="userSearch" type='text' >
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
</div>
