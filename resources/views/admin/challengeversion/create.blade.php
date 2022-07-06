<x-app-layout>

    <x-slot name="title">Create Version of Challenge {{ $challenge->name }}</x-slot>

    <x-slot name="header">Create Version of Challenge {{ $challenge->name }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
        <x-form.input label="Name" name="name" required="true" :value="old('name')" />
        <x-form.input label="Challenge Gallery version suffix" name="galleryNote" :value="old('galleryNote')" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id')" :list="$categories" />
        <livewire:admin.wistia-picker name="wistiaId" label="Challenge Gallery Preview Video - Wistia ID" :wistiaId="old('wistiaId')" />
        <x-form.textarea name="blurb"
            label="Gallery Blurb"
            sublabel="ex. 'Design your own 3D balance toy.'"
            :value="old('blurb')" />
        <x-form.textarea name="chromebookInfo"
            label="Chromebook Info"
            :value="old('chromebookInfo')" />
        <x-form.dropdown label="Prerequisite Challenge"
            :value="old('prereqChallengeVersion')"
            name="prereqChallengeVersion"
            :list="$challenges" />
        <x-form.input label="Information Article URL"
                name="infoUrl"
                :value="old('infoUrl')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Create Challenge Version</button>
        </div>

    </form>

</x-app-layout>
