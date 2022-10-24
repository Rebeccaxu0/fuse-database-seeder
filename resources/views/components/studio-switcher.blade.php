<div x-data="{ studioListOpen: false }" class="float-right uppercase flex flex-row-reverse items-center relative mx-4 mt-2">
    <livewire:join-studio-form />
    @if ($activeStudio && $otherStudios->count())
        <label class="m-0 p-0 cursor-pointer" @click="studioListOpen = true">
            @if ($multipleSchools && $activeStudio->school)
            {{ $activeStudio->school->name }} &ndash;
            @endif
            {{ $activeStudio->name }}
            <span class="text-fuse-blue">&#9660;</span>
        </label>
        <ul x-show="studioListOpen" @click.outside="studioListOpen = false"
            class="absolute top-0 right-0 p-2 mt-12 mr-4 z-10 max-h-48
                @if ($multipleSchools) w-96 @else w-64 @endif
                bg-gray-100 overflow-scroll border rounded-md">
            @foreach ($otherStudios as $studio)
            <li class="list-none m-0 px-2 rounded-lg hover:bg-fuse-teal-dk hover:text-white">
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
    @elseif ($activeStudio)
        <label class="m-0 p-0">
            @if ($multipleSchools && $activeStudio->school)
            {{ $activeStudio->school->name }} &ndash;
            @endif
            {{ $activeStudio->name }}
        </label>
    @endif
</div>
