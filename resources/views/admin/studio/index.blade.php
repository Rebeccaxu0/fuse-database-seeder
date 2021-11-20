<x-app-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
      <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">{{ __('Studios') }}</h2>
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
        <summary>{{ __(':student_count students', ['student_count' => $studio->students()->count()]) }}</summary>
        <ol>
          @foreach ($studio->students as $student)
          <li><label class="text-xs text-fuse-teal">{{ $student->name }}</label></li>
          @endforeach
        </ol>
      </details>
      <details>
        <summary>{{ __(':fac_count facilitators', ['fac_count' => $studio->facilitators()->count()]) }}</summary>
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
    
    </div>
  </article>
</x-app-layout>