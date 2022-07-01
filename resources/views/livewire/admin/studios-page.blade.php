<div class="relative">
    <x-admin.district-subnav />

    <x-slot name="header">{{ __('Studios') }}</x-slot>

    @livewire ('school-district-search-bar')
    @if ($school)
    <div>
        <a href="{{ route('admin.schools.createstudios', $school) }}">
            <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studios</button>
        </a>
    </div>
    <fieldset class='border p-2'>
    <legend class="font-semibold">{{ __('School & District') }}</legend>
    <div class="">
        <span class="float-right">
            <a href="{{ route('admin.schools.edit', $school->id) }}"><button type="reset">{{ __('Edit School') }}</button></a>
            <br>
            <form method="post"
                  action="{{ route('admin.schools.destroy', $school->id) }}"
                  class="inline-block">
                @method('delete')
                @csrf
                <button type="destroy">{{ __('Delete School') }}</button>
            </form>
        </span>
        {{ $school->name }}
    </div>
    <div>
        @if ($school->district)
        {{ $school->district->name }}
        @else
        {{ __('No parent district') }}
        @endif
    </div>
    <div>{{ __('Package: ') }}
        @if ($school->package)
        {{ __('":spackage" overrides district package ":dpackage"', [
        'spackage' => $school->package->name,
        'dpackage' => ($school->district && $school->district->package)
          ? $school->district->package->name
          : __('<none>')]) }}
        @elseif ($school->district && $school->district->package)
        {{ __('":package" inherited from district', ['package' => $school->district->package->name]) }}
        @else
        {{ __('No Package Set') }}
        @endif
    </fieldset>
    <fieldset class='border p-2'>
    <legend class="font-semibold">{{ __('Facilitators') }}</legend>
    <div class="text-sm">
        @foreach ($school->facilitators as $user)
        <a href="{{ route('admin.users.show', $user) }}">{{ $user->full_name }} ({{ $user->name }})</a>,
        @endforeach
    </div>
    </fieldset>
    @endif
    <div class="mt-8">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    @if (! $school)
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('District') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('School') }}
                    </th>
                    @endif
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-gray-700 bold">
                        {{ __('Package') }}
                    </th>
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
                        @if (! $school)
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
                        <td class="border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                            {{ $studio->package->name ??  __('Inherited') ?? __('No package set') }}
                            </p>
                        </td>
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
        @if (! $schoolId)
        {{ $studios->links() }}
        @endif
    </div>
</div>
