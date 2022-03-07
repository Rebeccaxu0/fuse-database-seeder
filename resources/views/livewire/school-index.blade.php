<div class="relative">
    <div>
        @livewire ('district-search-bar')
        <div>
            <input type="hidden" name="currentdistrict" value="{{ $setdistrict->id }}">
            <h4 class="mt-2 mb-2"> District: {{ $setdistrict['name'] }} </h4>
        </div>
    </div>
    <div class="mt-8" x-data="{ open: @entangle('showSchools') }">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="bg-white border-gray-200 text-left text-black bold">
                        {{ __('District') }}
                    </th>
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
                @foreach ($setdistrict->schools as $school)
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
                        <td class="border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $school->district->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
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
                                    <ol>
                                        @foreach ($school->studios as $studio)
                                            <li><span class="text-xs text-fuse-teal">{{ $studio->name }}</span>
                                            </li>
                                        @endforeach
                                    </ol>
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
                                    <ol>
                                        @foreach ($school->facilitators as $user)
                                            <li><span class="text-xs text-fuse-teal">{{ $user->name }}</span></li>
                                        @endforeach
                                    </ol>
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
                                    <ol>
                                        @foreach ($school->gradelevels as $grade)
                                            <li><label class="text-xs text-fuse-teal">{{ $grade->name }}</label></li>
                                        @endforeach
                                    </ol>
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
                                    <button type="reset"><img class="h-6 w-6" src="/editpencil.png"></button>
                                </a>
                                <form method="post" action="{{ route('admin.schools.destroy', $school->id) }}"
                                    class="inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="destroy"><img class="h-6 w-6" src="/deletetrash.svg"></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
