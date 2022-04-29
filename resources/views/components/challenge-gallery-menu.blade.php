<ul class="border-b border-zinc-300 text-right">
    <li class="m-0 inline-block">
        @if (request()->routeIs('student.challenges'))
            <span class="inline-block py-4 px-8 border-x border-t border-zinc-300 bg-white -mb-[6px]">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="text-orange-500"/>
            </span>
        @else
            <a class="inline-block py-4 px-8 -mb-[6px]"
               href="{{ route('student.challenges') }}">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="text-slate-500"/>
            </a>
        @endif
    </li>
    <li class="m-0 inline-block">
        @if (request()->routeIs('student.ideas'))
            <span class="inline-block py-4 px-8 border-x border-t border-zinc-300 bg-white -mb-[6px]">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="text-orange-500"/>
            </span>
        @else
            <a class="inline-block py-4 px-8 -mb-[6px]"
               href="{{ route('student.ideas') }}">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="text-slate-500"/>
            </a>
        @endif
    </li>
    <li class="m-0 inline-block">
        @if (request()->routeIs('student.help_finder'))
            <span class="inline-block py-4 px-8 border-x border-t border-zinc-300 bg-white -mb-[6px]">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('ideas') }}" class="text-orange-500"/>
            </span>
        @else
            <a class="inline-block py-4 px-8 -mb-[6px]"
               href="{{ route('student.help_finder') }}">
            <x-icon icon="idea" viewBox="60.4 90.6" width=50 height=50
                    fill="currentColor"
                    alt="{{ __('Help Finder') }}" class="text-slate-500"/>
            </a>
        @endif
    </li>
</ul>
