<x-admin-layout>

  <x-slot name="title">{{ __('Studios') }}</x-slot>

  <x-slot name="header">{{ __('Studios') }}</x-slot>

  <a href="{{ route('admin.studios.create') }}">
    <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studio</button>
  </a>
  @foreach($studios as $studio)
  <h3 class="mt-2 mb-2">{{ $studio->name }}
    <span class="pl-2">
      <a href="{{ route('admin.studios.edit', $studio->id) }}">
        <button><img class="h-6 w-6" src="/editpencil.png"></button>
      </a>
      <form method="post" action="{{ route('admin.studios.destroy', $studio->id) }}" class="inline-block">
        @method('delete')
        @csrf
        <button type="submit"><img class="h-6 w-6" src="/deletetrash.png"></button>
      </form>
    </span>
  </h3>
  <label class="text-xs">{{ $studio->description }}</label>
  <details>
    <summary>{{ __(':student_count students', ['student_count' => count($studio->students)]) }}</summary>
    <ol>
      @foreach ($studio->students as $student)
      <li><label class="text-xs text-fuse-teal">{{ $student->name }}</label></li>
      @endforeach
    </ol>
  </details>
  <details>
    <summary>{{ __(':fac_count facilitators', ['fac_count' => count($studio->facilitators)]) }}</summary>
    <ol>
      @foreach ($studio->facilitators as $facilitator)
      <li><label class="text-xs text-fuse-teal">{{ $facilitator->name }}</label></li>
      @endforeach
    </ol>
  </details>
  @if($studio->school)
  <label class="text-xs">{{ __('Parent school :school_name ',
    [
    'school_name' => $studio->school->name,
    ]) }}</label>
  @endif
  @endforeach

  {{ $studios->links() }}

</x-admin-layout>