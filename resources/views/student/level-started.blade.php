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

  <h1>
    <span class="font-thin">{{ $level->levelable->challenge->name }}</span>
    <span class="font-extrabold">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
  </h1>

  <div id="top">
    <section class="md:flex border">
      <div class="m-4 flex-1">
        <h2 class="font-medium">{{ __('The Challenge') }}</h2>
        {!! $level->challenge_desc !!}
      </div>
      <div class="bg-blue-200 flex-1">
        image
      </div>
    </section>

    <section class="mt-8">
      <h2 class="font-medium">{{ __('Stuff You Will Need') }}</h2>
      <div class="md:flex gap-4">
        <div class="flex-1 border p-4">
          {!! $level->stuff_you_need_desc !!}
        </div>
        <div class="flex-1 border p-4">
          {!! __('Works on a Chromebook?') !!}
        </div>
      </div>
    </section>
  </div>

  <div class="md:grid md:gap-4 md:grid-cols-3">
    <div id="middle" class="md:col-span-2">
      <section class="mt-8">
        <h2 class="font-medium">{{ __('Get Started') }}</h2>
        <section class="border p-4">
          {!! $level->get_started_desc !!}
        </section>
      </section>

      <section class="mt-8">
        <h2 class="font-medium">{{ __('How to Complete This Level') }}</h2>
        <div class="border p-4">
          {!! $level->how_to_complete_desc !!}
        </div>
      </section>

      <section class="mt-8">
          <h2 class="font-medium">{{ __('Power-up') }}</h2>
          <div class="border p-4">
              {!! $level->power_up_desc !!}
          </div>
      </section>
    </div>

    <aside id="sidebar">
      <section class="mt-8">
          <h2 class="font-medium">{{ __('Help') }}</h2>
          <div class="border p-4">
              {!! $level->get_help_desc !!}
          </div>
      </section>

      <section class="bg-fuse-teal">
          <h2 class="font-medium text-white">{{ __('Help Finder') }}</h2>
      </section>

      <section class="bg-fuse-teal">
          <a href="{{ $whats_next['route'] }}" class="block w-full h-full py-4">
              <h2 class="font-medium text-white">{{ __("What's Next") }}</h2>
              {{ $whats_next['text'] }}
          </a>
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
    <div class="pt-4 pb-8">
      <span class="hidden md:inline-block">
        <span class="font-light">{{ $level->levelable->challenge->name }}</span>
        <span class="font-extrabold">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
      </span>
      <x-progress-bar :levelable="$level->levelable" :user="auth()->user()" class="h-4" />
        <button class="btn">Save</button>
        <button class="btn">Complete</button>
    </div>
  </footer>

</x-app-layout>
