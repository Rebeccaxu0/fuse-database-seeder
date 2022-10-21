<x-app-layout>

    <x-slot name="title">Create Challenge</x-slot>

    <x-slot name="header">Create Challenge</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.challenges.store') }}" method="POST">
        @csrf
        <x-form.input label="Name"
            name="name"
            required="true"
            :value="old('name')" />
        <x-form.textarea name="description"
            label="Description"
            :value="old('description')" />
        <x-form.dropdown label="Prerequisite Challenge"
            name="prerequisite_challenge_id"
            none_label="<none>"
            :value="old('prerequisite_challenge_id')"
            :list="$challenges" />
        <x-form.dropdown label="Status"
            required="true"
            name="status"
            :value="old('status')"
            :list="$statuses" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                >Create Challenge</button>
        </div>
    </form>

</x-app-layout>

