<x-app-layout class="bg-neutral-100">
    <div class="border border-black shadow-lg">
        <div class="p-8 text-shadow shadow-black bg-blue-100 bg-cover"
     style="background-image: linear-gradient(to bottom, #297f9eaa, #086384dd), url('{{ $level->levelable->gallery_thumbnail_url }}')">
            <a class="text-white" href="{{ route('student.challenges') }}">
            <x-icon icon="chevron-left" class="border rounded-full inline-block text-white h-8 w-8 drop-shadow-contrast" /> {{ __('Challenge Gallery') }}
            </a>
            <h1 class="uppercase text-white text-center text-base font-extrabold">
            <span class="block">{{ $level->levelable->name }}</span>
            <span class="block text-2xl">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
            </h1>
            <div class="mx-16 flex items-center text-4xl">
                @if ($level->previous())
                <a href="{{ route('student.level', ['challengeVersion' => $level->levelable, 'level' => $level->previous()]) }}">
                    <x-icon icon="chevron-left" class="text-white h-12 w-12 drop-shadow-contrast" />
                </a>
                @endif
                <div class="inline-block w-full">
                    <x-progress-bar :levelable="$level->levelable" :user="auth()->user()" class="h-4" />
                </div>
                @if ($level->next())
                <a class="text-white"
                    href="{{ route('student.level', ['challengeVersion' => $level->levelable, 'level' => $level->next()]) }}">
                    <x-icon icon="chevron-right" class="text-white h-12 w-12 drop-shadow-contrast" />
                </a>
                @endif
            </div>
        </div>
        <div class="p-8 text-black text-center">
            @if (session('status'))
                <div class="status">
                    {{ session('status') }}
                </div>
            @endif
            @if ($available)
                @if ($startable)
                    <form action="{{ route('student.level_start', ['challengeVersion' => $level->levelable, 'level' => $level]) }}" method="POST">
                    @csrf
                        <button class="btn">
                            {{ __('Start') }}
                        </button>
                    </form>
                @else
                    <a href="{{ $prerequisite_route }}">{!! $prerequisite_text !!}</a>
                @endif
            @else
            {!! __('This Challenge is unavailable in your studio. <a href=":route">Please choose a different Challenge</a>, or ask your Facilitator to enable this Challenge.', ['route' => route('student.challenges')]) !!}
            @endif
        </div>
    </div>
</x-app-layout>
