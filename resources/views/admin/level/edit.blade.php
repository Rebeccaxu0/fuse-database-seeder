<x-app-layout>

    <x-slot name="title">{{ __('Edit Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number ]) }}</x-slot>

    <x-slot name="header">{{ __('Edit :copy Level :name', ['name' => $level->levelable->name . ' ' . $level->level_number, 'copy' => $copy ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PUT')
        @csrf
        <p> //preview image </p>
        <x-form.dropdown label="Parent Challenge" required="true" name="levelable_id" :value="old('levelable_id', $level->levelable_id)" :list="$parents" />
        <x-form.quill-textarea name="challenge" label="The Challenge" content="chalcontent" old="{!! $level->challenge_desc !!}" />
        <x-form.quill-textarea name="blurb" label="Blurb" content="blurbcontent" old="{!! $level->blurb !!}" />
        <p> //stuff you need images </p>
        <x-form.quill-textarea name="stuffyouneed" label="Stuff You Need" sublabel="ex. 'Chromebook, LED lights.'" content="syncontent" old="{!! $level->stuff_you_need !!}" />
        <x-form.quill-textarea name="gs" label="Get Started" content="gscontent" old="{!! $level->get_started_desc !!}" />
        <x-form.quill-textarea name="htc" label="How To Complete" content="htccontent" old="{!! $level->how_to_complete_desc !!}" />
        <x-form.quill-textarea name="gh" label="Get Help" content="ghcontent" old="{!! $level->get_help_desc !!}" />
        <x-form.quill-textarea name="pu" label="Power Up" content="pucontent" old="{!! $level->power_up_desc !!}" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save Level') }}</button>
        </div>
    </form>
</x-app-layout>