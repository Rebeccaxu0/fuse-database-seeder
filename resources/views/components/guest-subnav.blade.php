@props(['login' => false])

<x-subnav id="guest">
    <div class="absolute t-0 l-0 z-50 mt-3">
        <a href="//www.fusestudio.net"><img src="{{ asset('/img/logo.png') }}" alt="{{ __('FUSE Logo') }}" title="{{ __('FUSE Logo') }}" class="w-20"></a>
    </div>
    <x-subnav-ul id="guest-menu" class="md:pl-3 md:pr-20 md:ml-16">
        <li class="ml-4"><a class="px-2" href="//www.fusestudio.net/how-fuse-works/">{{ __('How FUSE Works') }}</a></li>
        <li><a class="px-2" href="//www.fusestudio.net/get-started/">{{ __('Get Started') }}</a></li>
        <li><a class="px-2" href="//www.fusestudio.net/challenges/">{{ __('Challenges') }}</a></li>
        <li><a class="px-2" href="//www.fusestudio.net/locations/">{{ __('Our Network') }}</a></li>
        <li><a class="px-2" href="//www.fusestudio.net/research/">{{ __('Research') }}</a></li>
        <li><a class="px-2" href="//www.fusestudio.net/about/">{{ __('About') }}</a></li>
        @if ($login)
        <li class="md:hidden"><a class="px-2" href="{{ route('login') }}">{{ __('Login') }}</a></li>
        <div class="hidden md:flex flex-col justify-center h-12 ml-12">
            <a href="{{ route('login') }}" class="uppercase text-white sm:btn">{{ __('Login') }}</a>
        </div>
        @endif
    </x-subnav-ul>
</x-subnav>
