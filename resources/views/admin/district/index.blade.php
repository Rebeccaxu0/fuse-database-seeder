<x-app-layout>

    <x-slot name="title">{{ __('Districts') }}</x-slot>

    <x-slot name="header">{{ __('Districts') }}</x-slot>

    <a href="{{ route('admin.districts.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add district</button>
    </a>
    <table class="min-w-full min-h-full leading-normal">
        <thead>
            <tr>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Package') }}
                </th>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Schools') }}
                </th>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Super Facilitators') }}
                </th>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Salesforce Account ID') }}
                </th>
                <th scope="col" class="ml-6 px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($districts as $district)
                <tr>
                    <td class="border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                            </div>
                            <div class="ml-3">
                                <a class="text-gray-900 underline whitespace-no-wrap"
                                    href="{{ route('admin.schools.index', ['district' => $district]) }}">
                                    {{ $district->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $district->package->name ?? __('No package set') }}
                        </p>
                    </td>
                    <td class="border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                        <details>
                            <summary>{{ __(':count', ['count' => count($district->schools)]) }}</summary>
                            <ul>
                                @foreach ($district->schools as $school)
                                    <li><span class="text-xs">{{ $school->name }}</span></li>
                                @endforeach
                            </ul>
                        </details>
                        </p>
                    </td>
                    <td class="border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                        <details>
                            <summary>{{ __(':count', ['count' => count($district->superFacilitators)]) }}</summary>
                            <ul>
                                @foreach ($district->superFacilitators as $user)
                                    <li><span class="text-xs">{{ $user->name }}</span></li>
                                @endforeach
                            </ul>
                        </details>
                        </p>
                    </td>
                    <td class="border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                            </div>
                            <div class="ml-3">
                                <p class="text-gray whitespace-no-wrap">
                                    {{ $district->salesforce_acct_id ?? __('No ID') }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="border-gray-200 bg-white">
                        <a href="{{ route('admin.districts.edit', $district->id) }}">
                            <button>{{ __('edit') }}</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
