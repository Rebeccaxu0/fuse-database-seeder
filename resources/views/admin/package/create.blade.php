<x-app-layout>

    <x-slot name="title">Create Package</x-slot>

    <x-slot name="header">Create Package</x-slot>

    <form class="mt-6" action="{{ route('admin.packages.store') }}" method="POST">
        @csrf
        <x-form.input label="Title"
            name="name"
            required="true" />
            <x-form.textarea label="Description"
                             name="description"
                             :value="old('description', '')" />
        <x-form.checkbox name="student_activity_tab_access"
                         label="Access to Student Activity Tab"
                         :checked="old('student_activity_tab_access', 0)" />
        <div class="-mx-3 mb-2">
            <span class="text-gray-700 mb-2 form-required">Allowed Challenges</span>
        </div>
        <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4">
            @foreach ($challenges as $challenge)
                <x-form.checkbox_array name="challenges" :value="$challenge->id" :label="$challenge->name" />
            @endforeach
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                id="btn-submit">Create Package</button>
        </div>
    </form>

</x-app-layout>

