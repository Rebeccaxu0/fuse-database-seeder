<x-app-layout>

    <x-slot name="title">Edit Challenge {{ $challenge->name }}</x-slot>

    <x-slot name="header">Edit Challenge {{ $challenge->name }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challenges.update', $challenge) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input name="name"
            label="Name"
            required="true"
            :value="old('name', $challenge->name)" />
        <x-form.textarea name="description"
            label="Description"
            :value="old('description', $challenge->description)" />

        <x-form.dropdown name="prerequisite_challenge_id"
            label="Prerequisite Challenge"
            none_label="<none>"
            :value="old('prerequisite_challenge_id', $challenge->prerequisite_challenge_id)"
            :list="$challenges" />

        <x-form.dropdown name="status"
            label="Status"
            required="true"
            :value="old('status', $challenge->status->value)"
            :list="$statuses" />
        <div class="italic">N.B. - Setting this to "Archive" will remove this Challenge from all Packages it's on.</div>

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                    class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                    id="btn-submit">Update Challenge</button>
        </div>
    </form>
</x-app-layout>

