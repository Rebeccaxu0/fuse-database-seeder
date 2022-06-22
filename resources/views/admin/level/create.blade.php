<x-app-layout>
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    <x-slot name="title">{{ __('Create Level') }}</x-slot>

    <x-slot name="header">{{ __('Create Level') }}</x-slot>

    <form id="frm" class="mt-6" action="{{ route('admin.levels.store') }}" method="POST">
        @csrf
        <x-form.dropdown label="{{ __('Challenge') }}" required="true" name="levelable_id" :value="old('levelable_id', $challengeVersion)" :list="$challengeVersions" />
        <p>// preview image</p>
        <x-form.quill-textarea
            name="challengeDesc"
            label="{{ __('The Challenge') }}"
            :value="old('challengeDesc')" />
        <x-form.quill-textarea
            name="blurb"
            label="{{ __('Blurb') }}"
            :value="old('blurb')" />
        <p> //stuff you need images </p>
        <x-form.quill-textarea
            name="stuffYouNeed"
            label="{{ __('Stuff You Need') }}"
            sublabel="{{ __('ex. \'Chromebook, LED lights.\'') }}"
            :value="old('stuffYouNeed')" />
        <x-form.quill-textarea
            name="getStarted"
            label="{{ __('Get Started') }}"
            :value="old('getStarted')" />
        <x-form.quill-textarea
            name="howToComplete"
            label="{{ __('How To Complete') }}"
            :value="old('howToComplete')" />
        <x-form.quill-textarea
            name="getHelp"
            label="{{ __('Get Help') }}"
            :value="old('getHelp')" />
        <x-form.quill-textarea
            name="powerUp"
            label="{{ __('Power Up') }}"
            :value="old('powerUp')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                {{ __('Create Level') }}
            </button>
        </div>
    </form>

</x-app-layout>
