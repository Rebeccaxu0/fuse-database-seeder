<x-app-layout>

    <x-slot name="title">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.update', $challengeversion) }}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challengeversion->name)"/>
        <x-form.textarea name="version description"/>
        <x-form.textarea name="blurb" :value="old('name', $challengeversion->blurb)"/>
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id', $challengeversion->challenge_category_id)" :list="$categories" />
        <x-form.dropdown label="Prerequisite Challenge" :value="old('prerequisite_challenge_version_id', $challengeversion->prerequisite_challenge_version_id)" name="prereqchal" :list="$challenges" />
        <x-form.input label="Information Article URL" name="infourl" :value="old('info_article_url', $challengeversion->info_article_url)"/>
        <livewire:admin.quill-text label="Gallery Description">
        
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Update Challenge Version') }}</button>
        </div>
    </form>

    <script>
        function checkBoxes() {
            if ($('#license_status').is(":checked")) $('#anonymize').prop("disabled", true).prop("checked", false);
        }
    </script>
</x-app-layout>
