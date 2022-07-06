<div class="border-b border-zinc-300 pr-2">
    <ul class="m-0 p-0 text-right">
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.districts.index')) -mb-[1px] bg-neutral-100 font-bold @endif
        ">
        @if (request()->routeIs('admin.districts.index'))
            Districts
        @else
        <a class="m-0 p-0" href="{{ route('admin.districts.index') }}">
            Districts
        </a>
        @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.schools.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.schools.index'))
                Schools
            @else
            <a class="m-0 p-0" href="{{ route('admin.schools.index') }}">
                Schools
            </a>
        </li>
        @endif
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.studios.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.studios.index'))
                Studios
            @else
            <a class="m-0 p-0" href="{{ route('admin.studios.index') }}">
                Studios
            </a>
            @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.users.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.users.index'))
                Users
            @else
            <a class="m-0 p-0" href="{{ route('admin.users.index') }}">
                Users
            </a>
            @endif
        </li>
    </ul>
</div>
