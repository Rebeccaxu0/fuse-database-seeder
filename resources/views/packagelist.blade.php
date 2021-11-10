<x-admin-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
      <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">{{ __('Packages') }}</h2>
      <button href="{{ route('login') }}" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add package</button> <!-- need to change link -->
      <div class="overflow-x-auto mt-6">
        @foreach($data as $item)
        <h3 class="mt-2 mb-2">{{ $item->name }}
          <span class="pl-2"> 
            <button id="edit"><img class="h-6 w-6" src="/editpencil.png"></button>
            <button id="delete"><img class="h-6 w-6" src="/deletetrash.png"></button>
          </span> 
        </h3>
        <label class="text-xs">{{ $item->description }}</label>
        <details>
          <summary>{{ __(':count challenges', ['count' => $item->challenges()->count()]) }}</summary>
          <ol>
            @foreach ($item->challenges as $challenge)
            <li><label class="text-xs text-fuse-teal">{{ $challenge->name }}</label></li>
            @endforeach
          </ol>
        </details>
        <label class="text-xs">{{ __('Used by :district_count districts, :school_count schools, and :studio_count studios',
          [
          'district_count' => $item->districts()->count(),
          'school_count' => $item->schools()->count(),
          'studio_count' => $item->studios()->count()
          ]) }}</label>
        @endforeach
      </div>
    </div>
  </article>
</x-admin-layout>
