@push('scripts')
<script type="text/javascript">
  document.querySelector('#{{ $id }}-navbar-toggle').addEventListener('change', function(){ document.querySelector('#{{ $id }}-menu').classList.toggle('hidden'); });
</script>
@endpush

<nav id={{ $id }}>
  <div class="md:container md:h-full relative flow-root" style="padding: 0">
    {{ $slot }}
    <div class="burger-wrapper float-right flex flex-col justify-center h-full mr-4">
      <label id="hamburger" for="{{ $id }}-navbar-toggle" class="md:hidden pt-0 text-white text-2xl transition-margin duration-500 ease-in-out cursor-pointer">☰</label>
      <input type="checkbox" id="{{ $id }}-navbar-toggle" name="{{ $id }}-navbar-toggle" class="hidden">
    </div>
  </div>
</nav>