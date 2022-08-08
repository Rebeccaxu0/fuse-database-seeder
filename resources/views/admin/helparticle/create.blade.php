<x-app-layout>

    <x-slot name="title">Create Help Article</x-slot>

    <x-slot name="header">Create Help Article</x-slot>

    <form id="frm" class="mt-6" action="{{ route('admin.helparticles.store') }}" method="POST">
        @csrf

        <x-form.input label="Name" name="name" required="true" :value="old('name')" />
        <x-form.textarea
            name="body"
            label="Article"
            :value="old('body')" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Help Article
            </button>
        </div>
    </form>

</x-app-layout>
