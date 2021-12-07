<x-navbar id="student">
  <!-- Logo -->
  <div class="absolute t-0 l-0 z-10 -mt-1 md:-ml-4">
    <a href="{{ route('student.dashboard') }}">
      <img src="/logo.png" alt="logo" class="w-20">
    </a>
  </div>
  <x-navbar-ul id="student-menu" class="md:pl-16 md:pr-20">
    <li class="md:-ml-3" style="border-left-width:0">
      <a {{ (request()->routeIs('student.challenges') ? 'class=active' : '') }}
        href="{{ route('student.challenges')}}">{{ __('Challenges') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('student.help_finder') ? 'class=active' : '') }}
        href="{{ route('student.help_finder')}}">{{ __('Help Finder') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('student.dashboard') ? 'class=active' : '') }}
        href="{{ route('student.dashboard')}}">{{ __('Dashboard') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('student.portfolio') ? 'class=active' : '') }}
        href="{{ route('student.portfolio')}}">{{ __('My Stuff') }}</a>
    </li>
    <li>
      <form method="POST" action="{{ route('logout') }}" class="h-full">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
          {{ __('Sign Out') }}
        </a>
      </form>
    </li>
  </x-navbar-ul>
  <div class="h-16 flex flex-col justify-center absolute top-0 right-0 mr-16 md:mr-4">
    <div class="border-white border-2 rounded-full h-10 w-10 bg-yellow-500"></div>
  </div>
</x-navbar>