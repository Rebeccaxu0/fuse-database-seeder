<div class="border-b border-zinc-300 pr-2">
    <ul class="m-0 p-0 text-right">
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.challenges.index')) -mb-[1px] bg-neutral-100 font-bold @endif
        ">
        @if (request()->routeIs('admin.challenges.index'))
            Meta Challenges
        @else
        <a class="m-0 p-0" href="{{ route('admin.challenges.index') }}">
            Meta Challenges
        </a>
        @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.challengeversions.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.challengeversions.index'))
                Challenges
            @else
            <a class="m-0 p-0" href="{{ route('admin.challengeversions.index') }}">
                Challenges
            </a>
            @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.helparticles.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.helparticles.index'))
                Help Articles
            @else
            <a class="m-0 p-0" href="{{ route('admin.helparticles.index') }}">
                Help Articles
            </a>
            @endif
        </li>
    </ul>
</div>
