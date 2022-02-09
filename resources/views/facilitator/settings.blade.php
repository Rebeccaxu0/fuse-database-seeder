<x-app-layout>

    <x-slot name="title">{{ __('My Studio Settings') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Settings') }}</x-slot>


    <h2 class="uppercase text-left">{{ __('Studio Code') }}</h2>

    <livewire:studio-code :studio="$studio" >

    <h2 class="uppercase text-left">{{ __('Studio Settings') }}</h2>

    <h3>{{ __('Dashboard Message') }}</h3>

    <h3>{{ __('Sign In') }}</h3>

    <h3>{{ __('Registration') }}</h3>

    <h3>{{ __('Website Features') }}</h3>

</x-app-layout>
