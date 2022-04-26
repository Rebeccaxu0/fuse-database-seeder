<x-app-layout>

    <x-slot name="title">{{ __('Create Challenge Version') }}</x-slot>

    <x-slot name="header">{{ __('Create Challenge Version') }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store', $challengeversion) }}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input label="Name" name="name" required="true" />
        <x-form.dropdown label="Category" required="true" name="category_id" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <p> //preview video </p>
        <x-form.textarea name="version description" sublabel="A short description to help differentiate between different versions of the same challenge." />

        <livewire:admin.quill-text name="blurb" label="Gallery Blurb" sublabel="ex. 'Design your own 3D balance toy.'" :challengeversion="$challengeversion">
            <livewire:admin.quill-text name="summary" label="Summary" :challengeversion="$challengeversion">
                ≈
                    <livewire:admin.quill-text name="facnotes" label="Facilitator Notes" :challengeversion="$challengeversion">
                        <livewire:admin.quill-text name="chromeinfo" label="Chromebook Info" :challengeversion="$challengeversion">
                            <div class="quill bg-white mt-2 mb-6">
                                <input name="test" type="hidden">
                                <div id="editor">
                                    <p> test </p>
                                </div>
                            </div>
                            <x-form.dropdown label="Prerequisite Challenge" :value="old('prerequisite_challenge_version_id', $challengeversion->prerequisite_challenge_version_id)" name="prereqchal" :list="$challenges" />
                            <x-form.input label="Information Article URL" name="infourl" :value="old('info_article_url', $challengeversion->info_article_url)" />
                            <div class="flex flex-wrap mt-4 -mx-3 mb-2">
                                <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Create Challenge Version') }}</button>
                            </div>
    </form>


</x-app-layout>