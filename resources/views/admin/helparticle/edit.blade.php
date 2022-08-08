<x-app-layout>

    <x-slot name="title">Edit Help Article "{{ $helparticle->name }}"</x-slot>

    <x-slot name="header">Edit Help Article "{{ $helparticle->name }}"</x-slot>

    <form id="frm" class="mt-6" action="{{ route('admin.helparticles.update', $helparticle) }}" method="POST">
        @csrf
        @method('PUT')

        <x-form.input label="Name" name="name" required="true" :value="old('name', $helparticle->name)" />
        <x-form.textarea
            name="body"
            label="Article"
            :value="old('body', $helparticle->body)" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Update Help Article
            </button>
        </div>
    </form>

</x-app-layout>
