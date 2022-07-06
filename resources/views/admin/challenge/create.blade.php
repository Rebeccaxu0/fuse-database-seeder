<x-app-layout>

    <x-slot name="title">Create Challenge</x-slot>

    <x-slot name="header">Create Challenge</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.challenges.store') }}" method="POST">
        @csrf
        <x-form.input label="Name"
            name="name"
            required="true" />
        <x-form.textarea name="description" label="Description"/>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                >Create Challenge</button>
        </div>
    </form>

</x-app-layout>

