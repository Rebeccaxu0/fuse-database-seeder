<div class="relative">
    <div>
        <a href="{{ route('admin.schools.createstudios', $setschool) }}">
            <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studios</button>
        </a>
        <div>
            <input type="hidden" name="currentdistrict" value="{{ $setdistrict->id }}">
            <h3 class="mt-2 mb-2">District: {{ $setdistrict['name'] }} </h3>
        </div>
        @livewire ('district-search-bar')
    </div>
    <div>
        <div>
            <input type="hidden" name="currentschool" value="{{ $setschool->id }}">
            <h3 class="mt-2 mb-2"> School: {{ $setschool['name'] }} </h3>
        </div>
        @livewire ('school-search-bar')
    </div>
    <div class="mt-8" x-data="{ open: @entangle('showStudios') }">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-gray-700 bold">
                    {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-gray-700 bold">
                    {{ __('School') }}
                    </th>
                    <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-gray-700 bold">
                    {{ __('Package') }}
                    </th>
                    <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-gray-700 bold">
                        {{ __('Code') }}
                    </th>
                    <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-gray-700 bold">
                        {{ __('Edit') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($setschool->studios as $studio)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                            </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $studio->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $studio->school->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $studio->package->name ?? __('No package set') }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                            </div>
                                <div class="ml-3">
                                    <p class="text-gray whitespace-no-wrap">
                                        {{ $studio->join_code ?? __('No code set') }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-1 py-1 border-b border-gray-200">
                                 <span class="pl-2">
                                    <a href="{{ route('admin.studios.edit', $studio->id) }}">
                                        <button type="reset"><img class="h-6 w-6" src="/editpencil.png"></button>
                                    </a>
                                <form method="post" action="{{ route('admin.studios.destroy', $studio->id) }}" class="inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="destroy"><img class="h-6 w-6" src="/deletetrash.png"></button>
                                </form>
                                </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <h3 class="mt-2 mb-2"> {{ $setschool['name'] }} Facilitators </h3>
        <div class="mb-4">
            <p class="text-xs">{{ __('Mark for removal') }}</p>
            @foreach ($setschool->facilitators as $user)
                <x-form.checkbox_array name="facilitatorsToRemove" :value="$user->id" :label="$user->name" />
            @endforeach
        </div>
        <p class="text-xs">{{ __('Search to add') }}</p>
        <div>
            @livewire('add-facilitator')
        </div>

</div>

