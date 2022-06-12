<section class="rounded-xl sm:col-span-3 md:col-span-2 bg-fuse-teal-dk">
    <a href="{{ route('student.help_finder') }}"
       class="w-full h-full flex flex-col items-center p-4">
        <img class="w-1/2"
             srcset="{{ asset('/img/dashboard-help-finder-4x.png') }} 4x, {{ asset('/img/dashboard-help-finder-2x.png') }} 2x"
             src="{{ asset('/img/dashboard-help-finder-2x.png') }}"
             alt="{{ __('Three help icons') }}">
        <button class="btn bg-emerald-700 text-white ring-transparent">{{ __('Help Finder') }}</button>
    </a>
</section>

