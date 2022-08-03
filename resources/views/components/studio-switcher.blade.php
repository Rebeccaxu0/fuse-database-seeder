@if ($otherStudios->count())
    @push('scripts')
        <script>
            document.getElementById('studio-list-toggle').addEventListener('change', function() {
                document.getElementById('studio-list-menu').classList.toggle('hidden');
            });
        </script>
    @endpush
@endif

<div class="py-4 px-12 md:absolute md:right-0">
    <div class="float-right uppercase flex items-center relative">
    @if ($activeStudio)
    <label for="studio-list-toggle" class="m-0 p-0 @if ($otherStudios->count()) cursor-pointer @endif">
        @if ($multipleSchools && $activeStudio->school)
        {{ $activeStudio->school->name }} &ndash;
        @endif
        {{ $activeStudio->name }}
        @if ($otherStudios->count())
        <span class="text-fuse-blue">&#9660;</span>
        @endif
    </label>
    <input type="checkbox" id="studio-list-toggle" name="studio-list-toggle" class="hidden">
    <livewire:join-studio-form />
    @if ($otherStudios->count())
    <ul id="studio-list-menu"
      class="absolute top-0 right-0 p-2 mt-12 mr-4 z-10
      w-64 max-h-48
      bg-gray-100
      overflow-scroll hidden border rounded-md">
    @foreach ($otherStudios as $studio)
    <li class="list-none m-0">
        <form action="{{ route('switch_studio', $studio) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="w-full text-left">
                @if ($multipleSchools && $studio->school)
                    {{ $studio->school->name }} &ndash;
                @endif
                {{ $studio->name }}
            </button>
        </form>
    </li>
    @endforeach
    </ul>
    @endif
    @else
    <livewire:join-studio-form />
    @endif
    </div>
</div>
