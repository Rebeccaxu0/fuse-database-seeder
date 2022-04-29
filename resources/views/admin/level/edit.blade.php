<x-app-layout>

    <x-slot name="title">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PUT')
        @csrf
        <p> //preview image </p>
        <x-form.textarea name="The Challenge QUILL">{{ old('description', '') }}</x-form.textarea>
        <x-form.dropdown label="Parent Challenge" required="true" name="levelable_id" :value="old('levelable_id', $level->levelable_id)" :list="$parents" />
        <p> //stuff you need images </p>
        <x-form.textarea name="Stuff You Need QUILL">{{ old('description', '') }}</x-form.textarea>
        
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save Level') }}</button>
        </div>
    </form>
</x-app-layout>