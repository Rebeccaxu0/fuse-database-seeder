<footer class="align-bottom bg-fuse-teal-100 py-4 max-w-screen">
    <div class="container">
        <div>
         <livewire:locale-switcher />
            <ul class="mt-12 leading-loose font-semibold list-none inline">
                <li class="list-none m-0 inline-block">
                    <a class="text-fuse-teal-dk" href="https://www.fusestudio.net/privacy">{{ __('Privacy Policy') }}</a>
                </li>
                <li class="list-none m-0 inline-block">
                    &CenterDot; <a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Terms of Use') }}</a> &CenterDot;
                </li>
                <li class="list-none m-0 inline-block">
                    <a class="text-fuse-teal-dk" href="https://www.fusestudio.net/terms-of-use">{{ __('Contact Us') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container mt-8">
        {{ __('Copyright © 2012-:current. All rights reserved.', ['current' => date('Y')]) }}
    </div>
</footer>
