<x-admin-layout>

  <x-slot name="title">{{ __('LTI PLatforms') }}</x-slot>

  <x-slot name="header">{{ __('LTI PLatforms') }}</x-slot>

  <a href="{{ route('admin.packages.create') }}">
    <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add platform</button>
  </a>
  @foreach ($lti_platform as $lti)
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

</x-admin-layout>
