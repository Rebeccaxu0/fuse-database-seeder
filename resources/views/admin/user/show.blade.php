<x-app-layout>

    <x-slot name="title">{{ __('User :name', ['name' => $user->full_name]) }}</x-slot>

    <x-slot name="header">{{ __('User :name', ['name' => $user->full_name]) }}</x-slot>

    <div>
        <span class="font-bold">{{ __('User Name:') }}</span> {{ $user->name }}
    </div>
    <div>
        <span class="font-bold">{{ __('Full Name:') }}</span> {{ $user->full_name }}
    </div>
    <div>
        <span class="font-bold">{{ __('Email:') }}</span> {{ $user->email }}
    </div>
    <div>
        <span class="font-bold">{{ __('Birthday:') }}</span> {{ $user->birthday }}
    </div>
    @if (! $studioMember)
        <div>
            @if ($active)
            {{ __('Alum Member') }}
            @else
            {{ __('No Activity (Abandoned SSO?)') }}
            @endif
        </div>
    @else
        <div>
            <span class="font-bold">{{ __('Roles:') }}</span>
                @forelse ($user->roles as $role)
                {{ $role->name }}@if (! $loop->last), @endif
                @empty
                {{ __('student') }}
                @endforelse
        </div>
        <div>
            <span class="font-bold">{{ __('Districts:') }}</span>
            @foreach ($user->deFactoDistricts() as $district)
                {{ $district->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
        <div>
            <span class="font-bold">{{ __('Schools:') }}</span>
            @foreach ($user->deFactoSchools() as $school)
                {{ $school->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
        <div>
            <span class="font-bold">{{ __('Studios:') }}</span>
            @foreach ($user->deFactoStudios() as $studio)
                {{ $studio->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
        <button class="btn">
            {{ __('Edit') }}
        </button>
    </a>
    <form action="{{ route('admin.users.makeAdmin', ['user' => $user]) }}" method="POST">
        @csrf
        <button class="btn">
            {{ __('Make User an Admin') }}
        </button>
        {{ __('NB - This will add the role \'admin\' and remove all other roles.') }}
    </form>
    <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn bg-red-500">
            {{ __('delete') }}
        </button>
    </form>
    <a href="{{ route('student.their_stuff', ['user' => $user]) }}">
        <button class="btn">
        {{ __('Artifacts') }}
        </button>
    </a>

</x-app-layout>

