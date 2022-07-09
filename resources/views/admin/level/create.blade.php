<x-app-layout>
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

    <x-slot name="title">Create Level</x-slot>

    <x-slot name="header">Create Level</x-slot>

    <form id="frm" class="mt-6" action="{{ route('admin.levels.store') }}" method="POST">
        @csrf
        <x-form.dropdown label="Challenge" required="true" name="levelable_id" :value="old('levelable_id', $challengeVersion)" :list="$challengeVersions" />
        <p>// preview image</p>
        <x-form.textarea
            name="challengeDesc"
            label="The Challenge"
            :value="old('challengeDesc')" />
        <x-form.textarea
            name="blurb"
            label="Blurb"
            :value="old('blurb')" />
        <p> //stuff you need images </p>
        <x-form.textarea
            name="stuffYouNeed"
            label="Stuff You Need"
            sublabel="ex. 'Chromebook, LED lights.'"
            :value="old('stuffYouNeed')" />
        <x-form.textarea
            name="getStarted"
            label="Get Started"
            :value="old('getStarted')" />
        <x-form.textarea
            name="howToComplete"
            label="How To Complete"
            :value="old('howToComplete')" />
        <x-form.textarea
            name="getHelp"
            label="Get Help"
            :value="old('getHelp')" />
        <x-form.textarea
            name="powerUp"
            label="Power Up"
            :value="old('powerUp')" />
        <x-form.textarea
            name="facilitatorNotes"
            label="Facilitator Notes"
            :value="old('facilitatorNotes')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Level
            </button>
        </div>
    </form>

</x-app-layout>
