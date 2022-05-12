<x-app-layout>

    <x-slot name="title">{{ __('Create Challenge Version') }}</x-slot>

    <x-slot name="header">{{ __('Create Challenge Version') }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @method('POST')
        @csrf
        <x-form.input label="Name" name="name" required="true" />
        <x-form.dropdown label="Parent Challenge" required="true" name="challenge_id" :value="$challenge->id" :list="$challenges" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id')" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <p> //preview video </p>
        <x-form.textarea name="version description" sublabel="A short description to help differentiate between different versions of the same challenge." />

        <x-form.quill-textarea name="blurb" label="Gallery Blurb" sublabel="ex. 'Design your own 3D balance toy.'" content="blurbcontent" />
        <x-form.quill-textarea name="summary" label="Summary" content="summarycontent" />
        <x-form.quill-textarea name="stuffyouneed" label="Stuff You Need" sublabel="ex. 'Chromebook, LED lights.'" content="syncontent" />
        <x-form.quill-textarea name="facnotes" label="Facilitator Notes" content="fncontent" />
        <x-form.quill-textarea name="chromeinfo" label="Chromebook Info" content="cbcontent" />
        <x-form.dropdown label="Prerequisite Challenge" :value="old('prerequisite_challenge_version_id')" name="prereqchal" :list="$challenges" />
        <x-form.input label="Information Article URL" name="infourl" :value="old('info_article_url')" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Create Challenge Version') }}</button>
        </div>
    </form>


</x-app-layout>