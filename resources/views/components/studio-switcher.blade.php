@push('scripts')
    <script type="text/javascript">
        document.getElementById('studio-list-toggle').addEventListener('change', function() {
            document.getElementById('studio-list-menu').classList.toggle('hidden');
        });
    </script>
@endpush

<div class="py-4 px-12 relative">
    <div class="float-right uppercase flex items-center">
    @if ($activeStudio)
      <label for="studio-list-toggle" class="m-0 p-0 @if (! empty($otherStudios)) cursor-pointer @endif">
        @if ($activeStudio->school) {{ $activeStudio->school->name }} &ndash; @endif {{ $activeStudio->name }} @if (! empty($otherStudios))<span class="text-fuse-blue">&#9660;</span> @endif
      </label>
      <input type="checkbox" id="studio-list-toggle" name="studio-list-toggle" class="hidden">
      <livewire:join-studio-form />
    <ul id="studio-list-menu"
      class="absolute top-0 right-0 mt-12 mr-4 z-10
      max-w-xs max-h-48
      bg-gray-100
      overflow-scroll hidden border rounded-md">
    @foreach ($otherStudios as $studio)
    <li class="list-none -indent-8 pl-8">
      <a href="{{ route('active_studio', $studio->id)}}">@if ($studio->school) {{ $studio->school->name }} &ndash; @endif {{ $studio->name }}</a>
    </li>
    @endforeach
    </ul>
    @else
    {{ __('Join a Studio') }}
    <livewire:join-studio-form />
    @endif
    </div>
</div>
