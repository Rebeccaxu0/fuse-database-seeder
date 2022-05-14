<x-app-layout>

    <x-slot name="title">{{ __('Create Version of Challenge :challenge', ['challenge' => $challenge->name ]) }}</x-slot>

    <x-slot name="header">{{ __('Create Version of Challenge :challenge', ['challenge' => $challenge->name ]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
        <x-form.input label="{{ __('Name') }}" name="name" required="true" :value="old('name')" />
        <x-form.input label="{{ __('Challenge Gallery version suffix') }}" name="galleryNote" :value="old('galleryNote')" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id')" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <livewire:admin.wistia-picker name="wistiaId" label="{{ __('Challenge Gallery Preview Video - Wistia ID') }}" :wistiaId="old('wistiaId')" />
        <x-form.textarea label="{{ __('Version Description (Short)') }}"
            name="versionDesc"
            sublabel="{{ __('A short description to help differentiate between different versions of the same challenge.') }}"
            :value="old('versionDesc')" />
        <x-form.quill-textarea name="blurb"
            label="{{ __('Gallery Blurb') }}"
            sublabel="{!! __('ex. \'Design your own 3D balance toy.\'') !!}"
            :value="old('blurb')" />
        <x-form.quill-textarea name="summary"
            label="{{ __('Summary') }}"
            :value="old('summary')" />
        <x-form.quill-textarea name="stuffYouNeed"
            label="Stuff You Need"
            sublabel="ex. 'Chromebook, LED lights.'"
            :value="old('stuffYouNeed')" />
        <x-form.quill-textarea name="facNotes"
            label="Facilitator Notes"
            :value="old('facNotes')" />
        <x-form.quill-textarea name="chromeInfo"
            label="Chromebook Info"
            :value="old('chromeInfo')" />
        <x-form.dropdown label="Prerequisite Challenge"
            :value="old('prereqChallengeVersion')"
            name="prereqChallengeVersion"
            :list="$challenges" />
        <x-form.input label="{{ __('Information Article URL') }}"
                name="infoUrl"
                :value="old('infoUrl')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Create Challenge Version') }}</button>
        </div>

    </form>

</x-app-layout>
