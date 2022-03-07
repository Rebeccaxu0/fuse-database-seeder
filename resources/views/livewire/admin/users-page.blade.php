<div>
  <livewire:admin.users-online-toggle label="{{ __('Only Show Users Online') }}" :is_active="$onlyOnline" >
  <select wire:model="districtFilter">
      <option value="0">All</option>
      @foreach ($districts as $district)
      <option value="{{ $district->id }}">{{ $district->name }}</option>
      @endforeach
  </select>
  <select wire:model="rolesFilter">
    <option value="all">{{ __('All Users') }}</option>
    <option value="students">{{ __('Only Students') }}</option>
    <option value="facs">{{ __('Only Facilitators') }}</option>
    <option value="staff">{{ __('Only FUSE Staff') }}</option>
  </select>
  <h3>{{ $rolesFilter }}</h3>
  <h3>{{ $query }}</h3>
  <input wire:model.debounce.300ms="userSearch" type="text" placeholder="{{ __('Filter by name, email, or username.') }}">
    @foreach ($users as $user)
    <div>
        <div class="inline-block -mb-0.5 border-2 border-slate-300 {{ $user->isOnline() ? 'bg-fuse-green-500': '' }} rounded-lg w-4 h-4">
              <span class="sr-only">Status: {{ $user->isOnline() ? __('Online') :  __('Offline') }}"</span>
          </div>
          {{ $user->full_name }} ({{ $user->name }}) <{{ $user->email }}>
    </div>
    @endforeach

    {{ $users->links() }}
</div>
