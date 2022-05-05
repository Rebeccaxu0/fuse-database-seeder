<x-app-layout>

    <x-slot name="title">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PATCH')
        @csrf
        <p> //preview image </p>
        <x-form.dropdown label="Parent Challenge" required="true" name="levelable_id" :value="old('levelable_id', $level->levelable_id)" :list="$parents" />
        <livewire:admin.quill-text name="challenge" label="The Challenge" content="chalcontent" old="{!! $level->challenge_desc !!}">
        <livewire:admin.quill-text name="blurb" label="Blurb" content="blurbcontent" old="{!! $level->blurb !!}">
        <p> //stuff you need images </p>
                <livewire:admin.quill-text name="stuffyouneed" label="Stuff You Need" sublabel="ex. 'Chromebook, LED lights.'" content="syncontent" old="{!! $level->stuff_you_need !!}">
                <livewire:admin.quill-text name="gs" label="Get Started" content="gscontent" old="{!! $level->get_started_desc !!}">
                <livewire:admin.quill-text name="htc" label="How To Complete" content="htccontent" old="{!! $level->how_to_complete_desc !!}">
                <livewire:admin.quill-text name="gh" label="Get Help" content="ghcontent" old="{!! $level->get_help_desc !!}">
                <livewire:admin.quill-text name="pu" label="Power Up" content="pucontent" old="{!! $level->power_up_desc !!}">
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Update Level') }}</button>
        </div>
    </form>
</x-app-layout>