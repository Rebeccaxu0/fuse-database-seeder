<div class="border-b border-zinc-300 pr-2">
    <ul class="m-0 p-0 text-right">
        <li class="m-0 p-0 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('student.challenges')) -mb-[1px] bg-neutral-100 @endif
        ">
        @if (request()->routeIs('student.challenges'))
        <x-icon icon="challenge-gallery" width=75 height=75
                fill="currentColor"
                alt="{{ __('Challenge Gallery') }}" class="inline text-orange-500"/>
            <div class="absolute bg-neutral-100 w-full h-1 bottom">&nbsp;</div>
        @else
        <a class="m-0 p-0" href="{{ route('student.challenges') }}">
            <x-icon icon="challenge-gallery" width=75 height=75
                    fill="currentColor"
                    alt="{{ __('Challenge Gallery') }}" class="inline text-slate-500"/>
        </a>
        @endif
        </li>
        @if (auth()->user()->activeStudio->allow_ideas)
        <li class="m-0 p-0 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('student.ideas')) bg-neutral-100 @endif ">
            @if (request()->routeIs('student.ideas'))
            <x-icon icon="idea" width=75 height=75
                    fill="currentColor"
                    alt="{{ __('Ideas') }}" class="inline text-orange-500"/>
            <div class="absolute bg-neutral-100 w-full h-1 bottom">&nbsp;</div>
            @else
            <a class="m-0 p-0" href="{{ route('student.ideas') }}">
                <x-icon icon="idea" width=75 height=75
                        fill="currentColor"
                        alt="{{ __('Ideas') }}" class="inline text-slate-500"/>
            </a>
            @endif
        </li>
        @endif
        <li class="m-0 p-0 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('student.help_finder')) bg-neutral-100 @endif ">
            @if (request()->routeIs('student.help_finder'))
            <x-icon icon="help-finder" width=75 height=75
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="inline text-orange-500"/>
            <div class="absolute bg-neutral-100 w-full h-1 bottom">&nbsp;</div>
            @else
            <a class="m-0 p-0" href="{{ route('student.help_finder') }}">
                <x-icon icon="help-finder" width=75 height=75
                        fill="currentColor"
                        alt="{{ __('Help Finder') }}" class="inline text-slate-500"/>
            </a>
            @endif
        </li>
    </ul>
</div>
