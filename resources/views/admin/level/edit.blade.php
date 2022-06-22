<x-app-layout>

    <x-slot name="title">{{ __('Edit :name Level :number', [
        'name' => $level->levelable->name,
        'number' => $level->level_number,
        ]) }}</x-slot>

    <x-slot name="header">{{ __('Edit :name Level :number', [
        'name' => $level->levelable->name,
        'number' => $level->level_number,
        ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="levelable_id" value="{{ $level->levelable->id }}">

        <p> //preview image </p>
        <x-form.quill-textarea
            name="challengeDesc"
            label="{{ __('The Challenge') }}"
            :value="old('challengeDesc', $level->challenge_desc)" />
        <x-form.quill-textarea
            name="blurb"
            label="{{ __('Blurb') }}"
            :value="old('blurb', $level->blurb)" />
        <p> //stuff you need images </p>
        <x-form.quill-textarea
            name="stuffYouNeed"
            label="{{ __('Stuff You Need') }}"
            sublabel="{{ __('ex. \'Chromebook, LED lights.\'') }}"
            :value="old('stuffYouNeed', $level->stuff_you_need)" />
        <x-form.quill-textarea
            name="getStarted"
            label="{{ __('Get Started') }}"
            name="gscontent"
            :value="old('getStarted', $level->get_started_desc)" />
        <x-form.quill-textarea
            name="howToComplete"
            label="{{ __('How To Complete') }}"
            :value="old('howToComplete', $level->how_to_complete_desc)" />
        <x-form.quill-textarea
            name="getHelp"
            label="{{ __('Get Help') }}"
            :value="old('getHelp', $level->get_help_desc)" />
        <x-form.quill-textarea
            name="powerUp"
            label="{{ __('Power Up') }}"
            :value="old('powerUp', $level->power_up_desc)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save Level') }}</button>
        </div>
    </form>
</x-app-layout>
