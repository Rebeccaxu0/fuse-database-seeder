<x-app-layout>
    <x-slot name="title">{{ __('Create Level') }}</x-slot>

    <x-slot name="header">{{ __('Create Level') }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.store') }}" method="POST">
        @csrf
        <x-form.textarea name="The Challenge QUILL">{{ old('description', '') }}</x-form.textarea>
        <p> //preview image </p>
        <div class="mb-2">
            <span class="text-gray-700 mb-2 form-required">{{ __('Associated Challenge(s)') }}</span>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 mb-4">
            @foreach ($parents as $parent)
            <x-form.checkbox_array name="parents" :value="$parent->id" :label="$parent->name" 
            :active="$level->levelable()->id" />
            @endforeach
        </div>
        <x-form.textarea name="Stuff You Need QUILL">{{ old('description', '') }}</x-form.textarea>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Level
            </button>
        </div>
    </form>

</x-app-layout>