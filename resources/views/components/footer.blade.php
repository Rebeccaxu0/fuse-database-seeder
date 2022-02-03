<footer class="align-bottom bg-fuse-teal-500 py-10 max-w-screen">
    <div class="container grid gap-x-2 grid-cols-2 md:grid-cols-3">
    <div class="md:col-start-2">
        <span class="text-slate-600 font-extrabold text-3xl lg:text-4xl pb-10 font-display">
          {{ __(':count students', ['count' => $students]) }}
        </span>
        <ul class="leading-loose font-semibold list-none">
            <li class="list-none m-0"><a class="text-slate-800" href="https://www.fusestudio.net/privacy">{{ __('Privacy Policy') }}</a></li>
            <li class="list-none m-0"><a class="text-slate-800" href="https://www.fusestudio.net/terms-of-use">{{ __('Terms of Use') }}</a></li>
            <li class="list-none m-0"><a class="text-slate-800" href="mailto:info@fusestudio.net">info@fusestudio</a></li>
        </ul>
        <livewire:locale-switcher />
    </div>
    <div class="pl-8 md:col-start-3">
        <span class="text-slate-600 font-extrabold text-3xl lg:text-4xl pb-10 font-display">
          {{ __(':count schools', ['count' => $schools]) }}
        </span>
        <ul class="leading-loose font-semibold">
            <li class="list-none m-0"><a class="text-slate-800" href="https://www.fusestudio.net/privacy">{{ __('Privacy Policy') }}</a></li>
            <li class="list-none m-0"><a class="text-slate-800" href="https://www.fusestudio.net/terms-of-use">{{ __('Terms of Use') }}</a></li>
            <li class="list-none m-0"><a class="text-slate-800" href="mailto:info@fusestudio.net">info@fusestudio</a></li>
        </ul>
        </div>
    <div class="col-start-1 md:mt-32 md:row-start-1">
      <div class="w-44 bg-fuse-yellow px-4 py-1 rounded-lg">
        <svg viewbox="0 0 393.1 128.5" xmlns="http://www.w3.org/2000/svg" alt="FUSE" title="FUSE" xml:space="preserve"><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 96.4h294.8V0H0Z"/></clipPath></defs><path style="fill:#81edf8;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 5.4h21v86.4H0Zm245.3 86.4h-21V5.4h21z" transform="matrix(1.33333 0 0 -1.33333 0 128.5)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 1.8h21v20H0Z" transform="matrix(1.33333 0 0 -1.33333 0 128.5)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0h-21v-20h45V0Z" transform="matrix(1.33333 0 0 -1.33333 28 50.3)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0h-42v-20h63V0z" transform="matrix(1.33333 0 0 -1.33333 56 3)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M287.3 21.8h-63v-20h63z" transform="matrix(1.33333 0 0 -1.33333 0 128.5)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0h-21v-20h45V0Z" transform="matrix(1.33333 0 0 -1.33333 327 50.3)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0v20h-63V0h42z" transform="matrix(1.33333 0 0 -1.33333 383 29.8)"/><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 128.5)"><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0c0-7.6-4.3-11.6-12.5-11.6C-20.6-11.6-25-7.5-25 0v62h-23.5V-.7c0-17.9 14.3-29.9 35.6-29.9C8.4-30.7 22.3-19 22.3-.8v62.9H0Z" transform="translate(117.6 32)"/><path style="fill:#6cb306;fill-opacity:1;fill-rule:nonzero;stroke:none" d="M0 0v-6.9c0-17.7 13.2-28.3 35.3-28.3 23.2 0 33.6 14.6 33.6 29C69 11 53.1 16.7 40.5 21.3c-9 3.2-16.6 6-16.6 11.6 0 5.5 4 8.7 10.9 8.7 7.8 0 12.5-4 12.5-11V30l21.4-4.5v6.9C68.7 48.9 55 60 34.7 60 15.3 60 1.6 48.4 1.6 32c0-17 15.5-22.7 28-27.4 9-3.3 16.7-6.2 16.7-12.2 0-6-3.7-9-11.1-9-5.2 0-13.7 1.5-13.7 11.5" transform="translate(147.3 35.8)"/></g></svg>
      </div>
        <p class="text-5xl font-thin">level up.</p>
    </div>
    <div class="col-span-full mt-8 text-right">
    {{ __('Copyright © 2012-:current. All rights reserved.', ['current' => date('Y')]) }}
    </div>
    </div>
</footer>
