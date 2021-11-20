<x-app-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
      <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">{{ __('Schools') }}</h2>
      <a href="{{ route('admin.schools.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add School</button>
      </a>
      @foreach($schools as $school)
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
        <summary>{{ __(':count studios', ['count' => $school->studios()->count()]) }}</summary>
        <ol>
          @foreach ($school->studios as $studio)
          <li><label class="text-xs text-fuse-teal">{{ $studio->name }}</label></li>
          @endforeach
        </ol>
      </details>
      @if($school->district)
      <label class="text-xs">{{ __('Parent district :district_name ',
        [
        'district_name' => $school->district->name,
        ]) }}</label>
        @endif
      @endforeach

      {{ $schools->links() }}
    
    </div>
  </article>
</x-app-layout>