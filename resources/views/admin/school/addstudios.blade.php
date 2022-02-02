<x-app-layout>

    <x-slot name="title">{{ __('Create Studios for :name', ['name' => $school->name]) }}</x-slot>

    <x-slot name="title">{{ __('Create Studios for :name', ['name' => $school->name]) }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.studios.store') }}" method="POST">
        @csrf
        <x-form.input label="Number of studios to add" name="number" required="true" />
        <x-form.textarea name="Names"/>

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                {{ __('Save Studios') }}
            </button>
        </div>

    </form>

</x-app-layout>
