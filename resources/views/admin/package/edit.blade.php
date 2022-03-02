<x-app-layout>

    <x-slot name="title">{{ __('Edit Package :name', ['name' => $package->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Package ":name"', ['name' => $package->name]) }}</x-slot>

    <form id="delete-frm" class="" action="{{ route('admin.packages.destroy', $package) }}"
        method="POST">
        @method('DELETE')
        @csrf
        <button class="float-right bg-red-500">{{ __('Delete Package') }}</button>
    </form>
    <form class="mt-6" action="{{ route('admin.packages.update', $package) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $package->name)" />
        <x-form.textarea name="description">{{ old('description', $package->description) }}</x-form.textarea>
        <x-form.checkbox label="Access to Student Activity Tab" name="student_activity_tab_access"
            :checked="old('student_activity_tab_access', $package->student_activity_tab_access)" />
        <div class="mb-2">
            <span class="text-gray-700 mb-2 form-required">Allowed Challenges</span>
        </div>
        <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4">
            @foreach (\App\Models\Challenge::all() as $challenge)
                <x-form.checkbox_array name="challenges" :value="$challenge->id" :label="$challenge->name"
                    :active="$package->challenges()->find($challenge->id)" />
            @endforeach
        </div>

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                {{ __('Save Package') }}
            </button>
        </div>

    </form>

    </x-admin-layout>
