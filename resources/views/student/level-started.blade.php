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

</script>
@endpush

<x-app-layout>
    <x-slot name="title">{{ __(':challenge - Level :number', ['challenge' => $level->levelable->challenge->name, 'number' => $level->level_number]) }}</x-slot>

    <div x-data="{ saveCompleteFormOpen: false}" >

    <h1 class="mt-0">
        <span class="font-bold">{{ $level->levelable->challenge->name }}</span>
        <span class="font-medium">{{ __('L:number', ['number' => $level->level_number]) }}</span>
        @if(auth()->user()->isAdmin())
        (<a href="{{ route('admin.levels.edit', [$level]) }}">edit</a>)
        @endif
    </h1>

    @if (session('status'))
    <div class="status">
        {{ session('status') }}
    </div>
    @endif
    <div class="bg-neutral-200 rounded-xl py-4 px-6 lg:grid lg:gap-8 lg:grid-cols-3">
        <article id="main" class="lg:col-span-2">
            <section class="bg-white border rounded-xl shadow p-4">
                <div class="text-black text-lg font-bold m-0 text-left">{{ __('The Challenge') }}</div>
                <div class="lg:flex">
                    <div class="m-4 flex-1">
                        {!! $level->challenge_desc !!}
                    </div>
                    <div class="bg-blue-200 flex-1">
                    <img src="{{ $level->levelable->gallery_thumbnail_url }}" />
                    </div>
                </div>
            </section>

            <section class="bg-neutral-100 rounded-xl shadow mt-8 p-4">
                <div class="text-black text-lg font-bold m-0 text-left">{{ __('Stuff You Need') }}</div>
                <div class="lg:flex gap-4">
                    <div class="flex-1 border p-4">
                        {!! $level->stuff_you_need_desc !!}
                    @if ($level->hasMedia('file_you_need'))
                    <div class="font-bold mt-3">{{ __('Files:') }}</div>
                    <ul>
                    @foreach ($level->getMedia('file_you_need') as $file)
                        <li><a href="{{ $file->getUrl() }}">{{ $file->basename }}</a></li>
                    @endforeach
                    </ul>
                    @endif
                    </div>
                    @if ($level->levelable->chromebook_info)
                    <div class="flex-1 border p-4">
                        {!! $level->levelable->chromebook_info !!}
                    </div>
                    @endif
                </div>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <div class="text-black text-lg font-bold m-0 text-left">{{ __('Get Started') }}</div>
                {!! $fields['get_started_desc'] !!}
                <x-icon icon="video" class="text-fuse-teal-dk"/>
            </section>

            <section class="bg-white rounded-xl shadow mt-8 p-4">
                <div class="text-black text-lg font-bold m-0 text-left">{{ __('How to Complete This Level') }}</div>
                <div>
                    {!! $fields['how_to_complete_desc'] !!}
                </div>
                <a name="save-complete"></a>
                <div x-show="! saveCompleteFormOpen"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 scale-50"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-50">
                <a href="#save-complete"
                   id="save-btn-top"
                   class="btn"
                   @click="saveCompleteFormOpen = true; Livewire.emit('setType', 'save')"
                   >{{ __('Save') }}</a>
                <a href="#save-complete"
                   id="complete-btn-top"
                   class="btn"
                   @click="saveCompleteFormOpen = true; Livewire.emit('setType', 'complete')"
                   >{{ __('Complete') }}</a>
                </div>
                <div x-show="saveCompleteFormOpen"
                        x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-50"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-50"
                         ><livewire:level-save-or-complete-form :lid="$level->id"/></div>
            </section>

            @if ($fields['power_up_desc'])
            <section class="bg-neutral-100 rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('Power-up') }}</h2>
                {!! $fields['power_up_desc'] !!}
            </section>
            @endif

            @if ($fields['facilitator_notes_desc'] && ! auth()->user()->isStudent())
            <section class="bg-neutral-100 rounded-xl shadow mt-8 p-4">
                <h2 class="text-black text-lg font-bold">{{ __('Facilitator Notes') }}</h2>
                {!! $fields['facilitator_notes_desc'] !!}
            </section>
            @endif
        </article>

        <aside id="sidebar" class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:block">
            @if ($fields['get_help_desc'])
            <section class="">
                <h5 class="ml-4 mt-4 mb-1 uppercase">{{ __('Help') }}</h5>
                <div class="bg-neutral-100 border rounded-xl p-4">
                    {!! $fields['get_help_desc'] !!}
                </div>
            </section>
            @endif

            <section class="">
                <h5 class="ml-4 mt-8 mb-1 uppercase">{{ __('Help Finder') }}</h5>
                <x-help-finder-tile-pane :challengeVersion="$challengeVersion" :studio="$studio" gallery='0' />
            </section>

            <section class="">
                <h5 class="ml-4 mt-8 mb-1 uppercase">{{ __("What's Next") }}</h5>
                <a href="{{ $fields['whats_next_route'] }}" class="block rounded-xl bg-neutral-100 text-black p-8">
                    {{ $fields['whats_next_text'] }}
                </a>
            </section>

            <section class="">
                <h5 class="ml-4 mt-4 mb-1 uppercase">{{ __('Idea Project') }}</h5>
                <livewire:student.idea-edit :inspiration="$level->levelable" />
            </section>

        </aside>
    </div>

    <footer id="level-footer" class="z-10 fixed bottom-0 inset-x-0 h-[100px] sm:h-[75px] bg-fuse-teal text-white uppercase px-4">
        <div class="absolute top-0 inset-x-0 w-full h-[5px]">
            <div id="level-scroll-progress"
                 class="bg-fuse-orange h-full w-0"
                 aria-valuenow="0"
                 aria-valuemin="0"
                 aria-valuemax="100"
                 aria-valuetext="{{ __('percentage of level page seen') }}"
                 ></div>
        </div>
        <div class="pt-4 pb-8 px-4 flex flex-col sm:flex-row">
            <span class="hidden md:inline-block md:flex-1">
                <span class="font-light">{{ $level->levelable->challenge->name }}</span>
                <span class="font-extrabold">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
            </span>
            <div class="w-full sm:flex-1 mx-4">
                <x-progress-bar :levelable="$level->levelable" :user="auth()->user()" class="h-4" />
            </div>
            <div class="flex-1 flex mx-auto">
                <a href="#save-complete"
                   id="save-btn-bottom"
                   class="btn mx-2"
                   @click="saveCompleteFormOpen = true; Livewire.emit('setType', 'save')"
                   >{{ __('Save') }}</a>
                <a href="#save-complete"
                   id="complete-btn-bottom"
                   class="btn mx-2"
                   @click="saveCompleteFormOpen = true; Livewire.emit('setType', 'complete')"
                   >{{ __('Complete') }}</a>
            </div>
        </div>
    </footer>
    </div>

</x-app-layout>

