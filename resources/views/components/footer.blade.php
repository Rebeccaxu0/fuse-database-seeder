<footer class="align-bottom bg-fuse-teal-500 py-20 max-w-screen">
    <div class="container grid gap-x-2 grid-cols-2 md:grid-cols-3">
        <div class="">
            <span class="text-white font-extrabold text-3xl lg:text-4xl pb-10 font-display">
                {{ __(':count students', ['count' => $students]) }}
            </span>
            <ul class="mt-12 leading-loose font-semibold list-none">
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/privacy">{{ __('Privacy Policy') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Terms of Use') }}</a></li>
            </ul>
        </div>
        <div class="">
            <span class="text-white font-extrabold text-3xl lg:text-4xl pb-10 font-display">
                {{ __(':count schools', ['count' => $schools]) }}
            </span>
            <ul class="mt-12 leading-loose font-semibold">
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/privacy">{{ __('How FUSE Works') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Get Started') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Challenges') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Research') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Our Network') }}</a></li>
            </ul>
        </div>
        <div class="">
            <span class="text-white font-extrabold text-3xl lg:text-4xl pb-10 font-display">
                {{ __(':count states', ['count' => $states]) }}
            </span>
            <ul class="mt-12 leading-loose font-semibold">
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/privacy">{{ __('Grants') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Contact Us') }}</a></li>
                <li class="list-none m-0"><a class="text-fuse-teal-dk" href="mailto:info@fusestudio.net">{{ __('About') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="container mt-8">
        <livewire:locale-switcher />
        {{ __('Copyright © 2012-:current. All rights reserved.', ['current' => date('Y')]) }}
    </div>
</footer>
