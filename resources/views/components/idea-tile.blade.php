@props(['idea'])

<div class="aspect-square bg-white shadow-tile rounded-xl border border-gray-300 p-2">
    <a href="{{ route('student.idea', ['idea' => $idea]) }}">
        <div class="relative aspect-video w-full rounded-lg text-white"
             style="background: linear-gradient(to bottom, #0057b7 50%, #FFD700 50%);">
            <x-icon icon="idea" class="mx-auto" width=120 height=120 alt="{{ __('Idea') }}" />
        </div>
        <h4 class="font-semibold text-fuse-teal-dk text-xl">
            {{ $idea->name }}
        </h4>
        <div class="min-h-[4rem]">
            {{ str($idea->body)->limit(10) }}
        </div>
    </a>
</div>

