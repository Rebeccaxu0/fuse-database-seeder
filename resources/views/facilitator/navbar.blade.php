<x-navbar id="facilitator">
  <x-navbar-ul id="facilitator-menu">
    <li>
      <a {{ (request()->routeIs('facilitator.activity') ? 'class=active' : '') }}
         href="{{ route('facilitator.activity')}}">{{ __('Studio Activity') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('facilitator.people') ? 'class=active' : '') }}
         href="{{ route('facilitator.people')}}">{{ __('People') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('facilitator.challenges') ? 'class=active' : '') }}
         href="{{ route('facilitator.challenges')}}">{{ __('Challenges') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('facilitator.comments') ? 'class=active' : '') }}
         href="{{ route('facilitator.comments')}}">{{ __('Comments') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('facilitator.settings') ? 'class=active' : '') }}
         href="{{ route('facilitator.settings')}}">{{ __('Settings') }}</a>
    </li>
    <li>
      <a {{ (request()->routeIs('facilitator.announcements') ? 'class=active' : '') }}
         href="{{ route('facilitator.announcements')}}">{{ __('Announcements') }}</a>
    </li>
  </x-navbar-ul>
</x-navbar>