<x-app-layout>

    <x-slot name="title">{{ __('Create Challenge Version') }}</x-slot>

    <x-slot name="header">{{ __('Create Challenge Version') }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challenge->name)" />
        <x-form.textarea name="description"/>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Challenge Version
            </button>
        </div>
    </form>

</x-app-layout>