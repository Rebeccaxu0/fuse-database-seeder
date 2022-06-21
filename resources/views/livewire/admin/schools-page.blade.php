<div class="relative">
    <x-admin.district-subnav />

    <x-slot name="header">{{ __('Schools') }}</x-slot>
    <a href="{{ route('admin.schools.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add School</button>
    </a>

    <div>
        <label>
            <span class="font-bold">{{ __('District: ')}}</span>
            <select wire:model="districtFilter">
                <option value="0">{{ __('All') }}</option>
                <option value="-1">{{ __('Unafilliated') }}</option>
                @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="mt-8" x-data="{ open: @entangle('showSchools') }">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Name') }}
                    </th>
                    @if (! $districtFilter)
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('District') }}
                    </th>
                    @endif
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Package') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Studios') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Facilitators') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Grade(s)') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Partner') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Edit') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $school->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        @if (! $districtFilter)
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $school->district ? $school->district->name : __('NONE') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        @endif
                        <td class="border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $school->package->name ?? __('No package set') }}
                            </p>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <details>
                                    <summary>{{ __(':count studio(s)', ['count' => count($school->studios)]) }}
                                    </summary>
                                    <ul>
                                        @foreach ($school->studios as $studio)
                                            <li><span class="text-xs">{{ $studio->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </details>
                            </div>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <details>
                                    <summary>
                                        {{ __(':count facilitator(s)', ['count' => count($school->facilitators)]) }}
                                    </summary>
                                    <ul>
                                        @foreach ($school->facilitators as $user)
                                            <li><span class="text-xs">{{ $user->name }}</span></li>
                                        @endforeach
                                    </ul>
                                </details>
                            </div>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <details>
                                    <summary>{{ __(':count grade(s)', ['count' => count($school->gradelevels)]) }}
                                    </summary>
                                    <ul>
                                        @foreach ($school->gradelevels as $grade)
                                            <li><label class="text-xs">{{ $grade->name }}</label></li>
                                        @endforeach
                                    </ul>
                                </details>
                            </div>
                        </td>
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray whitespace-no-wrap">
                                        {{ $school->partner->name ?? __('No partner set') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="border-gray-200">
                            <span>
                                <a href="{{ route('admin.schools.edit', $school->id) }}">
                                    <button type="reset"><x-icon icon="edit" /></button>
                                </a>
                                <form method="post" action="{{ route('admin.schools.destroy', $school->id) }}"
                                    class="inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="destroy"><x-icon icon="trash" /></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $schools->links() }}

    </div>
</div>
