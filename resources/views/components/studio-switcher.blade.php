<div class="py-4 px-12">
    <div class="float-right uppercase flex items-center">
      {{ $activeStudio->school->name }} &ndash; {{ $activeStudio->name }}
      @livewire('join-studio-form')
    </div>
    @foreach ($otherStudios as $studio)
    <li><a href="">{{ $studio->school->name }} &ndash; {{ $studio->name }}</a></li>
    @endforeach
</div>
