<x-app-layout>

    <x-slot name="title">User {{ $user->full_name }}</x-slot>

    <x-slot name="header">User {{ $user->full_name }}</x-slot>

    <div>
        <span class="font-bold">User Name:</span> {{ $user->name }}
    </div>
    <div>
        <span class="font-bold">Full Name:</span> {{ $user->full_name }}
    </div>
    <div>
        <span class="font-bold">Email:</span> {{ $user->email }}
    </div>
    <div>
        <span class="font-bold">Birthday:</span> {{ $user->birthday }}
    </div>
    @if (! $studioMember)
        <div>
            @if ($active)
            Alum Member
            @else
            No Activity (Abandoned SSO?)
            @endif
        </div>
    @else
        <div>
            <span class="font-bold">Roles:</span>
                @forelse ($user->roles as $role)
                {{ $role->name }}@if (! $loop->last), @endif
                @empty
                student
                @endforelse
        </div>
        <div>
            <span class="font-bold">Districts:</span>
            @foreach ($user->deFactoDistricts() as $district)
                {{ $district->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
        <div>
            <span class="font-bold">Schools:</span>
            @foreach ($user->deFactoSchools() as $school)
                {{ $school->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
        <div>
            <span class="font-bold">Studios:</span>
            @foreach ($user->deFactoStudios() as $studio)
                {{ $studio->name }}@if (! $loop->last), @endif
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
        <button class="btn">
            Edit
        </button>
    </a>
    <form action="{{ route('admin.users.makeAdmin', ['user' => $user]) }}" method="POST">
        @csrf
        <button class="btn">
            Make User an Admin
        </button>
        NB - This will add the role \'admin\' and remove all other roles.
    </form>
    <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn bg-red-500">
            delete
        </button>
    </form>
    <a href="{{ route('impersonate', $user->id) }}">
        <button class="btn">
            Masquerade as {{ $user->full_name }}
        </button>
    </a>
    <a href="{{ route('student.their_stuff', ['user' => $user]) }}">
        <button class="btn">
        Artifacts
        </button>
    </a>

</x-app-layout>

