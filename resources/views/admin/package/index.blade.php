<x-app-layout>
    <x-slot name="title">{{ __('Packages') }}</x-slot>

    <x-slot name="header">{{ __('Packages') }}</x-slot>

    <a href="{{ route('admin.packages.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add package</button>
    </a>

    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach ($packages as $package)
            <div class="bg-gray-200 rounded-md p-2 mb-2">
                <div class="float-right pl-2">
                    <a href="{{ route('admin.packages.edit', $package->id) }}">
                        <button><img class="h-6 w-6" src="/editpencil.png"></button>
                    </a>
                    <a href="{{ route('admin.packages.copy', $package) }}">
                        <button><img class="h-6 w-6" src="/copyicon.png"></button>
                    </a>
                    <form method="post" action="{{ route('admin.packages.destroy', $package->id) }}"
                        class="inline-block">
                        @method('delete')
                        @csrf
                        <button type="submit"><img class="h-6 w-6" src="/deletetrash.png"></button>
                    </form>
                </div>
                <h3 class="mt-2 mb-2">{{ $package->name }}</h3>
                @if ($package->student_activity_tab_access)
                    <div>(Student Activity Tab Active)</div>
                @endif

                <label class="text-xs">{{ $package->description }}</label>
                <details>
                    <summary class="cursor-pointer">
                        {{ __(':count challenges', ['count' => count($package->challenges)]) }}</summary>
                    <ol class="list-none">
                        @foreach ($package->challenges as $challenge)
                            <li class="list-none text-xs text-fuse-teal">{{ $challenge->name }}</li>
                        @endforeach
                    </ol>
                </details>

                <div class="text-xs">
                    {{ __('Used by :district_count districts, :school_count schools, and :studio_count studios', [
                        'district_count' => count($package->districts),
                        'school_count' => count($package->schools),
                        'studio_count' => count($package->studios),
                    ]) }}
                </div>
            </div>
        @endforeach
    </div>

    </x-admin-layout>
