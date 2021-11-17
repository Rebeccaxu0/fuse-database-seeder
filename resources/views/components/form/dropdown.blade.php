@props(['package', 'selected', 'required' => false])
<!--WIP-->
<div class="mb-6">
  <select class="border block w-full rounded text-gray-700 h-10 bg-white hover:border-gray-400 focus:outline-none">
  {{ $slot }}
  </select>
</div>