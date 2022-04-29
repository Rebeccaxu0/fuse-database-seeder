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
                    <button><x-icon icon="edit" width=25 height=25 class="ml-2 text-black" /></button>
                    </a>
                    <form method="post" action="{{ route('admin.packages.copy', $package) }}"
                        class="inline-block">
                        @csrf
                        <button><x-icon icon="copy" width=25 height=25 class="ml-2 text-black" /></button>
                    </form>
                    <form method="post" action="{{ route('admin.packages.destroy', $package->id) }}"
                        class="inline-block">
                        @method('delete')
                        @csrf
                        <button><x-icon icon="trash" width=25 height=25 class="ml-2 text-black" /></button>
                    </form>
                </div>
                <h3 class="mt-2 mb-2">{{ $package->name }}</h3>
                @if ($package->student_activity_tab_access)
                    <div>(Student Activity Tab Active)</div>
                @endif

            <span class="text-xs">{{ $package->description }}</span>
            <details>
                <summary class="cursor-pointer">
                    {{ __(':count challenges', ['count' => count($package->challenges)]) }}</summary>
                <ul>
                    @foreach ($package->challenges as $challenge)
                    <li class="list-none text-xs">{{ $challenge->name }}</li>
                    @endforeach
                </ul>
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

