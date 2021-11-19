<x-app-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
      <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">{{ __('Packages') }}</h2>
      <a href="{{ route('admin.packages.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add package</button>
      </a>
      @foreach($data as $package)
      <h3 class="mt-2 mb-2">{{ $package->name }}
        <span class="pl-2">
          <a href="{{ route('admin.packages.edit', $package->id) }}">
            <button><img class="h-6 w-6" src="/editpencil.png"></button>
          </a>
          <form method="post" action="{{ route('admin.packages.destroy', $package->id) }}" class="inline-block">
            @method('delete')
            @csrf
            <button type="submit"><img class="h-6 w-6" src="/deletetrash.png"></button>
          </form>
        </span>
      </h3>
      <label class="text-xs">{{ $package->description }}</label>
      <details>
        <summary>{{ __(':count challenges', ['count' => $package->challenges()->count()]) }}</summary>
        <ol>
          @foreach ($package->challenges as $challenge)
          <li><label class="text-xs text-fuse-teal">{{ $challenge->name }}</label></li>
          @endforeach
        </ol>
      </details>
      <label class="text-xs">{{ __('Used by :district_count districts, :school_count schools, and :studio_count studios',
        [
        'district_count' => $package->districts()->count(),
        'school_count' => $package->schools()->count(),
        'studio_count' => $package->studios()->count()
        ]) }}</label>
      @endforeach
    </div>
    </div>
  </article>
</x-app-layout>