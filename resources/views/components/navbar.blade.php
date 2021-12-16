@push('scripts')
<script type="text/javascript">
  document.getElementById('{{ $id }}-toggle').addEventListener('change', function(){ document.getElementById('{{ $id }}-menu').classList.toggle('hidden'); });
</script>
@endpush

<nav id={{ "{$id}-navbar" }} {{ $attributes->merge() }}>
  <div class="md:container md:h-full relative flow-root" style="padding: 0">
    <div class="burger-wrapper md:hidden float-right flex flex-col justify-center h-full mr-4">
      <label id="{{ $id }}-hamburger" for="{{ $id }}-toggle" {{ $attributes->merge(['class' => "mb-0 md:hidden pt-0 {$hamburgerColor} text-2xl transition-margin duration-500 ease-in-out cursor-pointer"]) }}>☰</label>
      <input type="checkbox" id="{{ $id }}-toggle" name="{{ $id }}-navbar-toggle" class="hidden">
    </div>
    {{ $slot }}
  </div>
</nav>