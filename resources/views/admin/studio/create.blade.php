<x-admin-layout>

    <x-slot name="title">{{ __('Create Studios for :name', ['name' => $selectedschool->name])') }}</x-slot>

    <x-slot name="header">{{ __('Create Studios for :name', ['name' => $slectedschool->name])') }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.studios.store') }}" method="POST">
        @csrf
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Save Studios
            </button>
        </div>
    </form>
</x-admin-layout>
