@canImpersonate
<div class="relative">
  <div>{{ __('Masquerade as user') }}</div>
    <input
     wire:model.debounce.300ms="search"
     type="text"
     class="form-input mt-1 block w-full rounded"
     placeholder="User name/email/etc&hellip;"
     value="{{ $search }}" />
    <div wire:loading class="absolute z-10 w-full bg-white shadow-lg">
        <div class="list-item">Searching...</div>
    </div>

    @if (!empty($search))
    <div class="absolute bg-white rounded-lg left-0 right-0">

        <div class="relative z-10 w-full bg-white rounded-t-none shadow-lg list-group">
          @if (count($users))
          <ul>
            @foreach ($users as $user)
            <li class="mb-6">
              <a href="{{ route('impersonate', $user->id) }}">
                {{ $user->full_name }}
                @if ($user->email)
                &lt;{{ $user->email }}&gt;
                @endif
                ({{ $user->name }})
                @if ($user->activeStudio)
                  @if ($user->activeStudio->school)
                    {{ $user->activeStudio->school->name }} &ndash;
                  @endif
                  {{ $user->activeStudio->name }}
                  @endif
              </a>
            </li>
            @endforeach
            </ul>
            @else
              <div>No results</div>
          @endif
        </div>
    </div>
    @endif
</div>
@endCanImpersonate

