<x-app-layout>

    <x-slot name="title">{{ __('Create Challenge Version') }}</x-slot>

    <x-slot name="header">{{ __('Create Challenge Version') }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challengeversions.store') }}" method="POST">
        @csrf
        <x-form.input label="{{ __('Name') }}" name="name" required="true" :value="old('name')" />
        <x-form.input label="{{ __('Challenge Gallery version suffix') }}" name="galleryNote" :value="old('galleryNote')" />
        <x-form.dropdown label="Parent Challenge" required="true" name="challenge_id" :value="old('challenge_id')" :list="$challenges" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id')" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <livewire:admin.wistia-picker name="wistiaId" label="{{ __('Challenge Gallery Preview Video - Wistia ID') }}" :wistiaId="$challengeversion->gallery_wistia_video_id" />
        <div>
            <p class="mt-0 mb-0">{{ __('Levels') }}</p>
            <p class="mt-0 mb-0 text-xs">{{ __('Drag to reorder') }}</p>
            <ol class="list-none" name="order" id="sortlevels">
                @foreach ($challengeversion->levels as $i => $level)
                <li class="text-left list-none border-2 bg-slate-200 rounded-lg m-6 p-4"> <input name="level[{{ $level->id }}]" value="{{ $i+1 }}" type="hidden" />
                    @if ($level->blurb)
                    {!! $level->blurb !!}
                    @else
                    {{ __('Level :no (no blurb)', ['no' => $level->level_number]) }}
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
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
            :value="old('prereqChallengeVersion', $challengeversion->prerequisite_challenge_version_id)"
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
