@php
    use App\Enums\ChallengeStatus as Status;
@endphp

<x-app-layout>

    <x-slot name="title">Create Version of Challenge {{ $challenge->name }}</x-slot>

    <x-slot name="header">Create Version of Challenge {{ $challenge->name }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
        <x-form.input label="Name" name="name" required="true" :value="old('name')" />
        <x-form.input label="Challenge Gallery version suffix" name="gallery_note" :value="old('gallery_note')" />
        <x-form.dropdown label="Status" required="true" name="status" :value="old('status', Status::Beta)" :list="$statuses" />
        <x-form.dropdown label="Category" required="true" name="challenge_category_id" :value="old('challenge_category_id')" :list="$categories" />
        <livewire:admin.wistia-picker name="gallery_wistia_video_id" label="Challenge Gallery Preview Video - Wistia ID" :wistiaId="old('gallery_wistia_video_id')" />
        <x-form.textarea name="blurb"
            label="Gallery Blurb"
            sublabel="ex. 'Design your own 3D balance toy.'"
            :value="old('blurb')" />
        <x-form.textarea name="chromebook_info"
            label="Chromebook Info"
            :value="old('chromebook_info')" />
        <x-form.dropdown label="Prerequisite Challenge"
            :value="old('prerequisite_challenge_version_id')"
            name="prerequisite_challenge_version_id"
            :list="$challenges" />
        <x-form.input label="Information Article URL"
                name="info_article_url"
                :value="old('info_article_url')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Create Challenge Version</button>
        </div>

    </form>

</x-app-layout>
