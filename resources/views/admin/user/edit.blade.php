<x-app-layout>

    <x-slot name="title">{{ __('Edit User :name', ['name' => $user->full_name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit User :name', ['name' => $user->full_name]) }}</x-slot>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="{{ __('Username') }}" name="name" required="true" :value="old('name', $user->name)" />
        <x-form.input label="{{ __('Full Name') }}" name="fullName" required="true" :value="old('fullName', $user->full_name)" />
        <x-form.input label="{{ __('Email') }}" name="email" required="false" :value="old('email', $user->email)" />
        <div>
            <span class="font-bold">{{ __('Birthday:') }}</span>
            <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" >
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                    class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save') }}</button>
        </div>
    </form>

</x-app-layout>
