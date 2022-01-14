<div>
  <header class="bg-fuse-teal-dk p-2 h-18">
    <div class="container relative p-0" style="min-height: 3rem;">
      <a href="/" class="absolute left-0"><img src="/logo.png" alt="logo" class="w-20"></a>
      <nav class="flex justify-between text-xs lg:text-sm mx-auto pl-20">
        <input id="nav-toggle" type=checkbox class="hidden">
        <label id="show-button" for="nav-toggle" class="mt-4 ml-4 text-gray-300 hover:text-white">
          <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="https://www.w3.org/2000/svg">
            <title>Menu Open</title>
            <path d="M0 3h20v2H0V3z m0 6h20v2H0V9z m0 6h20v2H0V0z" />
          </svg>
        </label>
        <label id="hide-button" for="nav-toggle" class="mt-4 ml-4 hidden text-gray-300 hover:text-white">
          <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="https://www.w3.org/2000/svg">
            <title>Menu Close</title>
            <polygon points="11 9 22 9 22 11 11 11 11 22 9 22 9 11 -2 11 -2 9 9 9 9 -2 11 -2" transform="rotate(45 10 10)" />
          </svg>
        </label>
        <ul id="nav-menu" class="hidden absolute items-center top-0 left-20 z-10 text-auto bg-fuse-dk-teal">
          <x-nav.guest href="https://fusestudio.net/how-fuse-works/">{{ __('How FUSE Works') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/get-started/">{{ __('Get Started') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/challenges/">{{ __('Challenges') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/locations/">{{ __('Our Network') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/research/">{{ __('Research') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/about/">{{ __('About') }}</x-nav.guest>
          <x-nav.guest href="https://fusestudio.net/blog/">{{ __('Blog') }}</x-nav.guest>
        </ul>
      </nav>
    </div>
  </header>
</div>
