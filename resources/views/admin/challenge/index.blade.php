@php
    use App\Enums\ChallengeStatus as Status;
@endphp

<x-app-layout>

    <x-slot name="title">Meta Challenges</x-slot>

    <x-slot name="header">Meta Challenges</x-slot>

    <x-admin.challenge-subnav />

    <a href="{{ route('admin.challenges.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Meta Challenge</button>
    </a>

    <h2 class="m-0 p-0">{{ Status::Beta->label() }}</h2>
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($betaChallenges as $challenge)
        <x-admin.challenge.card :challenge="$challenge" />
        @endforeach
    </div>
    <h2 class="m-0 p-0">{{ Status::Current->label() }}</h2>
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($challenges as $challenge)
        <x-admin.challenge.card :challenge="$challenge" />
        @endforeach
    </div>
    <h2 class="m-0 p-0">{{ Status::Legacy->label() }}</h2>
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($legacyChallenges as $challenge)
        <x-admin.challenge.card :challenge="$challenge" />
        @endforeach
    </div>
    <h2 class="m-0 p-0">{{ Status::Archive->label() }}</h2>
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($archiveChallenges as $challenge)
        <x-admin.challenge.card :challenge="$challenge" />
        @endforeach
    </div>
</x-app-layout>
