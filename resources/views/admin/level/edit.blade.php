<x-app-layout>

    <x-slot name="title">Edit {{ $level->levelable->name }} Level {{ $level->level_number }}</x-slot>

    <x-slot name="header">Edit {{ $level->levelable->name }} Level {{ $level->level_number }}</x-slot>

    <form class="mt-6" action="{{ route('admin.levels.update', $level) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="levelable_id" value="{{ $level->levelable->id }}">

        <p> //preview image </p>
        <x-form.textarea
            name="challengeDesc"
            label="The Challenge"
            :value="old('challengeDesc', $level->challenge_desc)" />
        <x-form.textarea
            name="blurb"
            label="Blurb"
            :value="old('blurb', $level->blurb)" />
        <p> //stuff you need images </p>
        <x-form.textarea
            name="stuffYouNeed"
            label="Stuff You Need"
            sublabel="ex. 'Chromebook, LED lights.'"
            :value="old('stuffYouNeed', $level->stuff_you_need_desc)" />
        <div class="text-gray-700">Files You Need</div>
        @if ($level->hasMedia('file_you_need'))
        <ol class="mb-4">
        @foreach ($level->getMedia('file_you_need') as $file)
        <li>
            <a href="{{ $file->getUrl()}}">{{ $file->basename }}</a> (REMOVE)
        </li>
        @endforeach
        </ol>
        @endif
        <div class="mb-4">
        (ADD FILE)
        </div>
        <x-form.textarea
            name="getStarted"
            label="Get Started"
            name="getStarted"
            :value="old('getStarted', $level->get_started_desc)" />
        <x-form.textarea
            name="howToComplete"
            label="How To Complete"
            :value="old('howToComplete', $level->how_to_complete_desc)" />
        <x-form.textarea
            name="getHelp"
            label="Get Help"
            :value="old('getHelp', $level->get_help_desc)" />
        <x-form.textarea
            name="powerUp"
            label="Power Up"
            :value="old('powerUp', $level->power_up_desc)" />
        <x-form.textarea
            name="facilitatorNotes"
            label="Facilitator Notes"
            :value="old('facilitatorNotes', $level->facilitator_notes_desc)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Save Level</button>
        </div>
    </form>
</x-app-layout>
