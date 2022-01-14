<x-admin-layout>

  <x-slot name="title">{{ __('Districts') }}</x-slot>

  <x-slot name="header">{{ __('Districts') }}</x-slot>

  <a href="{{ route('admin.districts.create') }}">
    <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add district</button>
  </a>
  <table class="min-w-full leading-normal">
    <thead>
      <tr>
        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-left">
          <h3>Name </h3>
        </th>
        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-left">
          <h3>Package </h3>
        </th>
        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-left">
          <h3>Schools </h3>
        </th>
        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-left">
          <h3>Salesforce Account ID </h3>
        </th>
        <th scope="col" class="ml-6 px-5 py-3 bg-white  border-b border-gray-200 text-left">
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($districts as $district)
      <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
          <div class="flex items-center">
            <div class="flex-shrink-0">
            </div>
            <div class="ml-3">
              <p class="text-gray-900 whitespace-no-wrap">
              {{ $district->name }}
              </p>
            </div>
          </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
          <p class="text-gray-900 whitespace-no-wrap">
          {{ $district->package->name ?? __('No package set') }}
          </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
          <p class="text-gray-900 whitespace-no-wrap">
          <details>
            <summary>{{ __(':count', ['count' => count($district->schools)]) }}</summary>
            <ol>
              @foreach ($district->schools as $school)
              <li><label class="text-xs text-fuse-teal">{{ $school->name }}</label></li>
              @endforeach
            </ol>
          </details>
          </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
        <td class="px-5 py-5 border-b border-gray-200 bg-white">
          <a href="{{ route('admin.districts.edit', $district->id) }}">
            <button><img class="h-6 w-6" src="/editpencil.png"></button>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</x-admin-layout>
