<x-admin-layout>

  <x-slot name="title">{{ __('Schools') }}</x-slot>

  <x-slot name="header">{{ __('Schools') }}</x-slot>

  <a href="{{ route('admin.schools.create') }}">
    <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add School</button>
  </a>
  @foreach ($schools as $school)
  <h3 class="mt-2 mb-2">{{ $school->name }}
    <span class="pl-2">
      <a href="{{ route('admin.schools.edit', $school->id) }}">
        <button><img class="h-6 w-6" src="/editpencil.png"></button>
      </a>
      <form method="post" action="{{ route('admin.schools.destroy', $school->id) }}" class="inline-block">
        @method('delete')
        @csrf
        <button type="submit"><img class="h-6 w-6" src="/deletetrash.png"></button>
      </form>
    </span>
  </h3>
  <label class="text-xs">{{ $school->description }}</label>
  <details>
    <summary>{{ __(':count studios', ['count' => count($school->studios)]) }}</summary>
    <ol>
      @foreach ($school->studios as $studio)
      <li><label class="text-xs text-fuse-teal">{{ $studio->name }}</label></li>
      @endforeach
    </ol>
  </details>
  @if ($school->district)
  <label class="text-xs">
    {{ __('Parent district :district_name ', ['district_name' => $school->district->name]) }}
  </label>
  @endif
  @endforeach

  {{ $schools->links() }}

</x-admin-layout>
