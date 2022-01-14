<x-app-layout>

  <x-slot name="title">{{ __('Help Finder') }}</x-slot>

  <x-slot name="header">{{ __('Help Finder') }}</x-slot>

  @forelse ($challenges as $challenge)
    {{ $challenge->name }}
    <x-help-finder-tile :challenge="$challenge" />
  @empty
    <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
  @endforelse
</x-app-layout>
