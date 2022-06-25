@push('scripts')
<script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>

<script>
    const progressBar = document.getElementById('level-scroll-progress');
    const section = document.getElementById('env');

    const scrollProgressBar = () => {
            let scrollDist = Math.abs(-(section.getBoundingClientRect().top));
            let max = section.getBoundingClientRect().height + 75 - document.documentElement.clientHeight;
            let percentScrolled = (scrollDist / max) * 100;
            if (percentScrolled > 100) percentScrolled = 100;
            if (percentScrolled < 0) percentScrolled = 0;
            progressBar.style.width = percentScrolled.toFixed(2) + "%";
            progressBar.ariaValueNow = percentScrolled.toFixed(2);
        }

    scrollProgressBar;
    window.addEventListener('scroll', scrollProgressBar);
    window.addEventListener('resize', scrollProgressBar);

    function setArtifactFormType(type) {
            if (type == 'save') {
                    document.getElementById('save_type').checked = true;
                    document.getElementById('complete_type').checked = false;
                }
            else if (type == 'complete') {
                    document.getElementById('save_type').checked = false;
                    document.getElementById('complete_type').checked = true;
                }
        }
    const saveBtn = document.getElementById('save-btn');
    const completeBtn = document.getElementById('complete-btn');
    saveBtn.addEventListener('click', function() { setArtifactFormType('save')}, false);
    completeBtn.addEventListener('click', function() { setArtifactFormType('complete')}, false);
</script>
@endpush

<x-app-layout>
    <x-slot name="title">{{ __(':challenge - Level :number', ['challenge' => $level->levelable->challenge->name, 'number' => $level->level_number]) }}</x-slot>

    <div x-data="{ saveCompleteFormOpen: false}" >

    <h1>
        <span class="font-bold">{{ $level->levelable->challenge->name }}</span>
        <span class="font-medium">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
    </h1>

    @if (session('status'))
    <div class="status">
        {{ session('status') }}
    </div>
    @endif
    <div class="bg-slate-100 rounded-xl py-4 px-6 lg:grid lg:gap-8 lg:grid-cols-3">
        <article id="main" class="lg:col-span-2">
            <section class="bg-white border rounded-xl p-4">
                <h2 class="text-black text-lg font-bold">{{ __('The Challenge') }}</h2>
                <div class="lg:flex">
                    <div class="m-4 flex-1">
                        {!! $level->challenge_desc !!}
                    </div>
                    <div class="bg-blue-200 flex-1">
                        image
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('Stuff You Need') }}</h2>
                <div class="lg:flex gap-4">
                    <div class="flex-1 border p-4">
                        {!! $level->stuff_you_need_desc !!}
                    </div>
                    <div class="flex-1 border p-4">
                        {!! __('Works on a Chromebook?') !!}
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('Get Started') }}</h2>
                {!! $fields['get_started_desc'] !!}
                <x-icon icon="video" class="text-fuse-teal-dk"/>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('How to Complete This Level') }}</h2>
                {!! $fields['how_to_complete_desc'] !!}
                <a name="save-complete"></a>
                    <a href="#save-complete"
                       class="btn"
                       @click="saveCompleteFormOpen = ! saveCompleteFormOpen"
                       >{{ __('Save or Complete') }}</a>
                    <div x-show="saveCompleteFormOpen"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-50"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-50"
                         ><livewire:level-save-or-complete-form :lid="$level->id"/></div>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('Power-up') }}</h2>
                {!! $fields['power_up_desc'] !!}
            </section>
        </article>

        <aside id="sidebar">
            <section>
                <h2 class="uppercase text-black text-sm font-normal lg:mt-0 mb-2 ml-4">{{ __('Help') }}</h2>
                <div class="bg-white border rounded-xl p-4">
                    {!! $fields['get_help_desc'] !!}
                </div>
            </section>

            <section>
                <h2 class="uppercase text-black text-sm font-normal mb-2 ml-4">{{ __('Help Finder') }}</h2>
                <a href="{{ route('student.help_finder') }}" class="bg-fuse-teal block rounded-xl h-40">
                    <img src="">
                </a>
            </section>

            <section>
                <h2 class="uppercase text-black text-sm font-medium mb-2 ml-4">{{ __("What's Next") }}</h2>
                <a href="{{ $fields['whats_next_route'] }}" class="block py-4 rounded-xl bg-white text-black p-4">
                    {{ $fields['whats_next_text'] }}
                </a>
            </section>

            <section>
                <h2 class="uppercase text-black text-sm font-medium mb-2 ml-4">{{ __("Idea Project") }}</h2>
                <livewire:student.idea-edit :inspiration="$level->levelable" />
            </section>

        </aside>
    </div>

    <footer id="level-footer" class="z-10 fixed bottom-0 inset-x-0 h-[75px] bg-fuse-teal bg-opacity-90 text-white uppercase">
        <div class="absolute top-0 inset-x-0 w-full h-[5px]">
            <div id="level-scroll-progress"
                 class="bg-fuse-orange h-full w-0"
                 aria-valuenow="0"
                 aria-valuemin="0"
                 aria-valuemax="100"
                 aria-valuetext="{{ __('percentage of level page seen') }}"
                 ></div>
        </div>
        <div class="pt-4 pb-8 flex">
            <span class="hidden md:inline-block md:flex-1">
                <span class="font-light">{{ $level->levelable->challenge->name }}</span>
                <span class="font-extrabold">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
            </span>
            <div class="flex-1">
                <x-progress-bar :levelable="$level->levelable" :user="auth()->user()" class="h-4" />
            </div>
            <div class="flex-1 flex">
                <a href="#save-complete"
                   id="save-btn"
                   class="btn"
                   @click="saveCompleteFormOpen = ! saveCompleteFormOpen"
                   >{{ __('Save') }}</a>
                <a href="#save-complete"
                   id="complete-btn"
                   class="btn"
                   @click="saveCompleteFormOpen = ! saveCompleteFormOpen"
                   >{{ __('Complete') }}</a>
            </div>
        </div>
    </footer>
    </div>

</x-app-layout>

