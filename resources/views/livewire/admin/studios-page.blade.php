<div class="relative">
    <x-slot name="header">{{ __('Studios') }}</x-slot>

    @if (auth()->user()->isAdmin())
        <x-admin.district-subnav />
    @endif

    @if (auth()->user()->isAdmin())
        <livewire:school-district-search-bar />
    @endif

    <div class="text-fuse-teal-dk text-lg font-bold">{{ __('District: ')}}
    @if (auth()->user()->isAdmin())
        <select wire:model='activeDistrictId'>
        @foreach ($districts as $district)
            <option value="{{ $district->id }}" wire:key='{{ $district->id }}'>
                {{ $district->name }}
            </option>
        @endforeach
        </select>
    @else 
        {{ $activeDistrictName }}
    @endif

    <span class="">{{ __('School: ')}}
        @if ($schools->count())
            <select wire:model='activeSchoolId'>
            @foreach ($schools as $school)
                <option value="{{ $school->id }}" wire:key='{{ $school->id }}'>
                    {{ $school->name }}
                </option>
            @endforeach
            </select>
        @else
            {{ __('No schools in this District.') }}
        @endif
    </span>
    </div>

    @if ($activeSchool)
    @if (auth()->user()->isAdmin())
        <fieldset class='border p-2'>
            <legend class="font-semibold">{{ __('School & District') }}</legend>
            <div class="">
                <span class="float-right">
                    <a href="{{ route('admin.schools.edit', $activeSchool->id) }}"><button type="reset">{{ __('Edit School') }}</button></a>
                    <br>
                    <form method="post"
                        action="{{ route('admin.schools.destroy', $activeSchool->id) }}"
                        class="inline-block">
                        @method('delete')
                        @csrf
                        <button type="destroy">{{ __('Delete School') }}</button>
                    </form>
                </span>
                {{ $activeSchool->name }}
            </div>
            <div>
                @if ($activeSchool->district)
                {{ $activeSchool->district->name }}
                @else
                {{ __('No parent district') }}
                @endif
            </div>
            <div>{{ __('Package: ') }}
                @if ($activeSchool->package)
                {{ __('":spackage" overrides district package ":dpackage"', [
                'spackage' => $activeSchool->package->name,
                'dpackage' => ($activeSchool->district && $activeSchool->district->package)
                ? $activeSchool->district->package->name
                : __('<none>')]) }}
                @elseif ($activeSchool->district && $activeSchool->district->package)
                {{ __('":package" inherited from district', ['package' => $activeSchool->district->package->name]) }}
                @else
                {{ __('No Package Set') }}
                @endif
            </div>
        </fieldset>
    @endif

    <fieldset class='border p-2'>
        <legend class="font-semibold">{{ __('Facilitators') }}</legend>
        <div class="text-sm lg:grid grid-cols-2 gap-4">
            @forelse ($facilitators as $facilitator)
            <div class="border rounded-xl px-4 py-2 relative">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.show', $facilitator) }}">
                @endif
                    <span class="font-bold">{{ $facilitator->full_name }}</span> <span>{{ $facilitator->name }}</span> <span>&lt;{{ $facilitator->email }}&gt;</span>
                @if(auth()->user()->isAdmin())
                    </a>
                @endif
                <x-jet-danger-button class="float-right p-1" wire:click="removeFacilitator({{ $facilitator->id }}); refresh();" wire:key="s{{ $activeSchoolId}}-u{{ $facilitator->id }}" wire:loading.attr='disabled'>
                    <x-icon icon="trash" width=15 height=15 />
                </x-jet-danger-button>
                <div class="float-right rounded-xl overflow-hidden mx-2">
                    <livewire:facilitator.user-edit-modal :user="$facilitator" :wire:key="'edit-' . $facilitator->id" />
                </div>
            </div>
            @empty
                {{ __('No Facilitators assigned to this school.') }}
            @endforelse
        </div>

        <div>
            {{ __('Add Facilitator') }}
            <livewire:user-search-bar >
        </div>
    </fieldset>
    @endif

    @if ($activeSchool)
    <div>
        <a href="{{ route('admin.schools.createstudios', $activeSchool) }}">
            <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studios</button>
        </a>
    </div>
    @endif

    <div class="mt-8">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    @if (! $activeSchool)
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('District') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('School') }}
                    </th>
                    @endif
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Studio') }}
                    </th>
                    @if (auth()->user()->isAdmin())
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Package') }}
                    </th>
                    @endif
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Code') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Edit') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studios as $studio)
                    <tr class="odd:bg-white even:bg-gray-100">
                        @if (! $activeSchool)
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                @if ($studio->school && $studio->school->district)
                                <p class="ml-3 text-gray-900 whitespace-no-wrap">
                                {{ $studio->school->district->name }}
                                </p>
                                @endif
                            </div>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                @if ($studio->school)
                                <p class="ml-3 text-gray-900 whitespace-no-wrap">
                                {{ $studio->school->name }}
                                </p>
                                @endif
                            </div>
                        </td>
                        @endif
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <p class="ml-3 text-gray-900 whitespace-no-wrap">
                                    {{ $studio->name }}
                                </p>
                            </div>
                        </td>
                        @if (auth()->user()->isAdmin())
                        <td class="border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                            {{ $studio->packageText }}
                            </p>
                        </td>
                        @endif
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <p class="ml-3 text-gray whitespace-no-wrap">
                                    {{ $studio->join_code ?? __('No code set') }}
                                </p>
                            </div>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <a href="{{ route('admin.studios.edit', $studio->id) }}">
                                <button type="reset">
                                    <x-icon icon="edit" />
                                </button>
                            </a>
                            <form method="post" action="{{ route('admin.studios.destroy', $studio->id) }}"
                                class="inline-block">
                                @method('delete')
                                @csrf
                                <button type="destroy">
                                    <x-icon icon="trash" />
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (! $activeSchoolId && $studios->count())
        {{ $studios->links() }}
        @endif
    </div>
</div>
