@push('scripts')
<script type="text/javascript">
  document.querySelector('#facMenuToggle').addEventListener('change', function(){
    console.log('blip');
    document.querySelector('#fac-menu').classList.toggle('hidden');
  });
</script>
@endpush

<nav class="bg-fuse-green border-b border-gray-100 relative" style="min-height:2rem">
    <!-- facilitator Navigation Menu -->
    <ul id="fac-menu" class="hidden md:flex flex-col md:flex-row md:container justify-between md:h-8" style="padding: 0;">
      <x-fac-nav-link route="facilitator.activity" class="border-t-0 md:border-l border-white">
        {{ __('Studio Activity') }}
      </x-fac-nav-link>
      <x-fac-nav-link route="facilitator.people">
        {{ __('People') }}
      </x-fac-nav-link>
      <x-fac-nav-link route="facilitator.challenges">
        {{ __('Challenges') }}
      </x-fac-nav-link>
      <x-fac-nav-link route="facilitator.comments">
        {{ __('Comments') }}
      </x-fac-nav-link>
      <x-fac-nav-link route="facilitator.settings">
        {{ __('Settings') }}
      </x-fac-nav-link>
      <x-fac-nav-link route="facilitator.announcements">
        {{ __('Announcements') }}
      </x-fac-nav-link>
    </ul>
    <div class="absolute right-0 top-0 flex items-center mr-8">
      <label id="hamburger" for="facMenuToggle" class="md:hidden pt-0 text-white text-2xl transition-margin duration-500 ease-in-out cursor-pointer">☰</label>
      <input type="checkbox" id="facMenuToggle" name="facMenuToggle" class="hidden">
    </div>
</nav>