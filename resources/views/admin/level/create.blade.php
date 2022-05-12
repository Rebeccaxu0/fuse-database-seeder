<x-app-layout>
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    <x-slot name="title">{{ __('Create Level') }}</x-slot>

    <x-slot name="header">{{ __('Create Level') }}</x-slot>

    <form id="frm" class="mt-6" action="{{ route('admin.levels.store') }}" method="POST">
        @csrf
        <p> //preview image </p>
        <x-form.quill-textarea name="challenge_desc" label="The Challenge" />
        <x-form.dropdown label="Parent Challenge" required="true" name="levelable_id" :value="old('levelable_id')" :list="$parents" />
        <p> //stuff you need images </p>
        <x-form.quill-textarea name="syn_desc" label="Stuff You Need" />
        <x-form.quill-textarea name="gs_desc" label="Get Started" />
        <x-form.quill-textarea name="htc_desc" label="How To Complete" />
        <x-form.quill-textarea name="gh_desc" label="Get Help" />
        <x-form.quill-textarea name="pu_desc" label="Power Up" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create Level
            </button>
        </div>
    </form>

</x-app-layout>