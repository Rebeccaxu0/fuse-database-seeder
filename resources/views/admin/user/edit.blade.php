<x-app-layout>

    <x-slot name="title">Edit User {{ $user->full_name }}</x-slot>

    <x-slot name="header">Edit User {{ $user->full_name }}</x-slot>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Username" name="name" required="true" :value="old('name', $user->name)" />
        <x-form.input label="Full Name" name="fullName" required="true" :value="old('fullName', $user->full_name)" />
        <x-form.input label="Email" name="email" :value="old('email', $user->email)" />
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            @error('password')
            <span class="text-red-500">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" />
        </div>
        <div>
            <span class="font-bold">Birthday:</span>
            <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" >
            @error('birthday')
            <span class="text-red-500">
                {{ $message }}
            </span>
            @enderror
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                    id="btn-submit"
                    class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                    >Save</button>
        </div>
    </form>

</x-app-layout>
