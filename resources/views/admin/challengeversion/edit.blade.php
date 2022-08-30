@push('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            slist(document.getElementById("sortlevels"));
        });

        function slist(target) {
            // get list items
            let levels = target.getElementsByTagName("li"),
                current = null;
            // make draggable
            for (let l of levels) {
                l.draggable = true;
                //on start of drag
                l.ondragstart = (ev) => {
                    current = l;
                }
                // drag over
                l.ondragover = (evt) => {
                    evt.preventDefault();
                };
                // on drop
                l.ondrop = (evt) => {
                    evt.preventDefault();
                    if (l != current) {
                        let currentpos = 0,
                            droppedpos = 0;
                        for (let le = 0; le <= levels.length; le++) {
                            if (current == levels[le]) {
                                currentpos = le;
                            }
                            if (l == levels[le]) {
                                droppedpos = le;
                            }
                        }
                        if (currentpos < droppedpos) {
                            l.parentNode.insertBefore(current, l.nextSibling);
                        } else {
                            l.parentNode.insertBefore(current, l);
                        }
                    }
                    order = [];
                    i = 0;
                    for (let l of levels) {
                        i++;
                        console.log(l.getElementsByTagName("input"));
                        l.getElementsByTagName("input")[0].value = i;
                    }
                };
            }
        }
    </script>
@endpush

<x-app-layout>

    <x-slot name="title">Edit Version of Challenge "{{ $challengeversion->challenge->name }}"</x-slot>

    <x-slot name="header">Edit Version of Challenge "{{ $challengeversion->challenge->name }}"</x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="mt-6" id="editform" action="{{ route('admin.challengeversions.update', $challengeversion) }}" method="POST">
        @method('PUT')
        @csrf

        <x-form.input label="Name" name="name" required="true" :value="old('name', $challengeversion->name)" />

        <x-form.input label="Challenge Gallery version suffix" name="gallery_note" :value="old('gallery_note', $challengeversion->gallery_note)" />

        <x-form.dropdown label="Parent MetaChallege" required="true" name="challenge_id" :value="old('challenge_id', $challengeversion->challenge_id)" :list="$challenges" />

        <x-form.dropdown label="Category" required="true" name="challenge_category_id" :value="old('challenge_category_id', $challengeversion->challenge_category_id)" :list="$categories" />

        <livewire:admin.wistia-picker name="wistiaId" label="Challenge Gallery Preview Video - Wistia ID" :wistiaId="$challengeversion->gallery_wistia_video_id" />

        <div>
            <a href="{{ route('admin.levels.create', ['challengeVersion' => $challengeversion]) }}" class="float-right">
                Add Level
            </a>
            <p class="mt-0 mb-0">Levels</p>
            <p class="mt-0 mb-0 text-xs">Drag to reorder</p>
            <ol class="list-none" name="order" id="sortlevels">
                @foreach ($challengeversion->levels->sortBy('level_number') as $i => $level)
                <li class="text-left list-none border-2 bg-slate-200 rounded-lg m-6 p-4"> <input name="level[{{ $level->id }}]" value="{{ $i+1 }}" type="hidden" />
                    <a href="{{ route('admin.levels.edit', ['level' => $level]) }}" class="float-right"><x-icon icon="edit" /></a>
                    @if ($level->blurb)
                    {!! $level->blurb !!}
                    @else
                    Level {{ $level->level_number }} (no blurb)
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
        <x-form.textarea name="blurb"
            label="Gallery Blurb"
            sublabel="ex. 'Design your own 3D balance toy.'"
            :value="old('blurb', $challengeversion->blurb)" />
        <x-form.textarea name="chromebook_info"
            label="Chromebook Info"
            :value="old('chromebook_info', $challengeversion->chromebook_info)" />
        <x-form.dropdown label="Prerequisite Challenge"
            :value="old('prerequisite_challenge_version_id', $challengeversion->prerequisite_challenge_version_id)"
            name="prerequisite_challenge_version_id"
            :list="$challenges" />
        <x-form.input label="Information Article URL"
                name="info_article_url"
                :value="old('info_article_url', $challengeversion->info_article_url)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Save Challenge Version</button>
        </div>

    </form>

</x-app-layout>
