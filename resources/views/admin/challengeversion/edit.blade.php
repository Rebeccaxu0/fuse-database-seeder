<x-app-layout>

    <x-slot name="title">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Challenge Version :name', ['name' => $challengeversion->name]) }}</x-slot>

    <form class="mt-6" id="editform" action="{{ route('admin.challengeversions.update', $challengeversion) }}" method="POST">
        @method('PUT')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challengeversion->name)" />
        <x-form.dropdown label="Category" required="true" name="category_id" :value="old('challenge_category_id', $challengeversion->challenge_category_id)" :list="$categories" />
        <p> //preview image </p>
        <p> //gallery media </p>
        <p> //preview video </p>
        <div>
            <p class="mt-0 mb-0"> Levels </p>
            <p class="mt-0 mb-0 text-xs"> Drag to reorder </p>
            <ol class="list-none" name="order" id="sortlevels">
                @foreach ($challengeversion->levels as $i => $level)
                <li class="text-center list-none border-2 bg-slate-200 rounded-lg m-6 p-2 w-16"> <input name="level[{{$level->id}}]" value="{{$i+1}}" type="hidden"/>  {{$level->level_number}}</li>
                @endforeach
            </ol>
        </div>
        <x-form.textarea name="version description" sublabel="A short description to help differentiate between different versions of the same challenge." />
        <livewire:admin.quill-text name="blurb" label="Gallery Blurb" sublabel="ex. 'Design your own 3D balance toy.'" :challengeversion="$challengeversion">
            <livewire:admin.quill-text name="summary" label="Summary" :challengeversion="$challengeversion">
                <livewire:admin.quill-text name="stuffyouneed" label="Stuff You Need" sublabel="ex. 'Chromebook, LED lights.'" :challengeversion="$challengeversion">
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
                                <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Save Challenge Version') }}</button>
                            </div>

    </form>

    <!--<script src="https://cdn.quilljs.com/1.3.6/quill.js">
        $var quill = new Quill('#editor', {
            options = {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            }
        });

        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Populate hidden form on submit
            var tester = document.querySelector('input[name=test]');
            tester.value = JSON.stringify(quill.getContents());
        };
    </script>-->

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