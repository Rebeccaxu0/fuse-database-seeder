<x-app-layout>

    <x-slot name="title">{{ __('Create Challenge Version') }}</x-slot>

    <x-slot name="header">{{ __('Create Challenge Version') }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.challengeversions.store', $challenge) }}" method="POST">
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challenge->name) . ' v' . count($challenge->challengeVersions) + 1"/>
        <x-form.textarea name="version description"/>
        <x-form.textarea name="blurb"/>
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id')" :list="$categories" />
        <x-form.dropdown label="Prerequisite Challenge" :value="old('prerequisite_challenge_version_id')" name="prereqchal" :list="$challenges" />
        <x-form.input label="Information Article URL" name="infourl" :value="old('info_article_url')"/>
        <livewire:admin.quill-text label="Gallery Description">

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Challenge Version
            </button>
        </div>
    </form>

</x-app-layout>