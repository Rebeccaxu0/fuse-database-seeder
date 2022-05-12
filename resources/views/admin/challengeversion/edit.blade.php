<x-app-layout>

    <x-slot name="title">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <form class="mt-6" id="editform" action="{{ route('admin.challengeversions.update', $challengeversion) }}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challengeversion->name)" />
        <x-form.dropdown label="Parent Challenge" required="true" name="challenge_id" :value="old('challenge_id', $challengeversion->challenge_id)" :list="$challenges" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id', $challengeversion->challenge_category_id)" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <p> //preview video </p>
        <div>
            <p class="mt-0 mb-0"> Levels </p>
            <p class="mt-0 mb-0 text-xs"> Drag to reorder </p>
            <ol class="list-none" name="order" id="sortlevels">
                @foreach ($challengeversion->levels as $i => $level)
                <li class="text-left list-none border-2 bg-slate-200 rounded-lg m-6 p-4"> <input name="level[{{$level->id}}]" value="{{$i+1}}" type="hidden" />
                    @if ($level->blurb)
                    {!! $level->blurb !!}
                    @else
                    Current level {{ $level->level_number }} (no blurb)
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
        <x-form.textarea name="version description" sublabel="A short description to help differentiate between different versions of the same challenge." />
        <x-form.quill-textarea name="blurb" label="Gallery Blurb" sublabel="ex. 'Design your own 3D balance toy.'" content="blurbcontent" :old="$challengeversion->blurb" />
        <x-form.quill-textarea name="summary" label="Summary" content="summarycontent" :old="$challengeversion->summary" />
        <x-form.quill-textarea name="stuffyouneed" label="Stuff You Need" sublabel="ex. 'Chromebook, LED lights.'" content="syncontent" :old="$challengeversion->stuff_you_need" />
        <x-form.quill-textarea name="facnotes" label="Facilitator Notes" content="fncontent" :old="$challengeversion->facilitator_notes" />
        <x-form.quill-textarea name="chromeinfo" label="Chromebook Info" content="cbcontent" :old="$challengeversion->chromebook_info" />
        <x-form.dropdown label="Prerequisite Challenge" :value="old('prerequisite_challenge_version_id', $challengeversion->prerequisite_challenge_version_id)" name="prereqchal" :list="$challenges" />
        <x-form.input label="Information Article URL" name="infourl" :value="old('info_article_url', $challengeversion->info_article_url)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save Challenge Version') }}</button>
        </div>

    </form>


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

</x-app-layout>