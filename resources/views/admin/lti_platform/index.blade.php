<x-app-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
      <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">{{ __('LTI Platforms') }}</h2>
      <a href="{{ route('admin.packages.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add platform</button>
      </a>
      @foreach($lti_platform as $lti)
      <h3 class="mt-2 mb-2">{{ $lti->name }}
        <span class="pl-2">
          <a href="{{ route('admin.lti_platforms.edit', $lti->id) }}">
            <button><img class="h-6 w-6" src="/editpencil.png"></button>
          </a>
          <form method="post" action="{{ route('admin.lti_platforms.destroy', $lti->id) }}" class="inline-block">
            @method('delete')
            @csrf
            <button type="submit"><img class="h-6 w-6" src="/deletetrash.png"></button>
          </form>
        </span>
      </h3>
      <label class="text-xs">{{ $lti->description }}</label>
      @endforeach
    </div>
    </div>
  </article>
</x-app-layout>