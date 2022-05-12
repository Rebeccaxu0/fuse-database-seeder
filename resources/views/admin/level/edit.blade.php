<x-app-layout>

    <x-slot name="title">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.textarea name="The Challenge QUILL">{{ old('description', '') }}</x-form.textarea>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 mb-4">
            @foreach ($parents as $parent)
            <x-form.checkbox_array name="parents" :value="$parent->id" :label="$parent->name" />
            @endforeach
        </div>
        
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Update Level') }}</button>
        </div>
    </form>
</x-app-layout>