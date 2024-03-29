<div>
    <x-slot name="header">Users</x-slot>

    <x-admin.district-subnav />

  <livewire:admin.users-online-toggle label="{{ __('Only Show Currently Online Users') }}" :is_active="$onlyOnline" >
  <select wire:model="districtFilter">
    <option value="0">{{ __('All Districts') }}</option>
      @foreach ($districts as $district)
      <option value="{{ $district->id }}">{{ $district->name }}</option>
      @endforeach
  </select>
  <select wire:model="schoolFilter">
    <option value="0">{{ __('All Schools') }}</option>
      @foreach ($schools as $school)
      <option value="{{ $school->id }}">{{ $school->name }}</option>
      @endforeach
  </select>
  <select wire:model="rolesFilter">
    <option value="all">{{ __('All User Types') }}</option>
    <option value="students">{{ __('Only Students') }}</option>
    <option value="facs">{{ __('Only Facilitators') }}</option>
    <option value="superfacs">{{ __('Only Super-Facilitators') }}</option>
    <option value="staff">{{ __('Only FUSE Staff') }}</option>
  </select>
  {{-- <h3>{{ $query }}</h3> --}}
  <input wire:model.debounce.300ms="userSearch" type="text" placeholder="{{ __('Filter by name, email, or username.') }}">
    @foreach ($users as $user)
    <div>
        <div class="inline-block -mb-0.5 border-2 border-slate-300 {{ $user->isOnline() ? 'bg-fuse-green-500': '' }} rounded-lg w-4 h-4">
              <span class="sr-only">Status: {{ $user->isOnline() ? __('Online') :  __('Offline') }}"</span>
          </div>
          <a href="{{ route('admin.users.show', $user) }}">
              {{ $user->full_name }} ({{ $user->name }}) &lt;{{ $user->email }}&gt;
          </a>
    </div>
    @endforeach

    {{ $users->links() }}
</div>
