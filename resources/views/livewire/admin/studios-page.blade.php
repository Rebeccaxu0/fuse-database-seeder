<div class="relative">
    <x-admin.district-subnav />

    <x-slot name="header">{{ __('Studios') }}</x-slot>

    @if ($school)
    <div>
        <a href="{{ route('admin.schools.createstudios', $school) }}">
            <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studios</button>
        </a>
    </div>
    <h3 class="mt-2 mb-2">{{ __('District: :district (:package)', [
        'district' => $school->district ? $school->district->name : __('No District'),
        'package' => $school->district ? ($school->district->package ? $school->district->package->name : __('No Package Set')) : __('No District')]) }}</h3>
    <h3 class="mt-2 mb-2">{{ __('School: :school (:package)', [
        'school' => $school->name,
        'package' => $school->package ? $school->package->name : __('Inherited from district'),
        ]) }}
        <span>
            <a href="{{ route('admin.schools.edit', $school->id) }}"><button type="reset"><x-icon icon="edit" /></button></a>
            <form method="post"
                  action="{{ route('admin.schools.destroy', $school->id) }}"
                  class="inline-block">
                @method('delete')
                @csrf
                <button type="destroy"><x-icon icon="trash" /></button>
            </form>
        </span>
    </h3>
    @endif
    @livewire ('school-district-search-bar')
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
        @if ($school)
        <h3 class="mt-2 mb-2">{{ __(':school Facilitators', ['school' => $school->name]) }}</h3>
        <div class="mb-2">
            <p class="text-xs">{{ __('Mark for removal') }}</p>
            @foreach ($school->facilitators as $user)
                <x-form.checkbox_array name="facilitatorsToRemove" :value="$user->id" :label="$user->name" />
            @endforeach
        </div>
        <p class="text-xs">{{ __('Search to add') }}</p>
        <div>
            @livewire('add-facilitator')
        </div>
        @endif
        {{ $studios->links() }}
    </div>
</div>
