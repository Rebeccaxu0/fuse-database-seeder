<div class="border-b border-zinc-300 pr-2">
    <ul class="m-0 p-0 text-right">
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.districts.index')) -mb-[1px] bg-neutral-100 font-bold @endif
        ">
        @if (request()->routeIs('admin.districts.index'))
        {{ __('Districts') }}
        @else
        <a class="m-0 p-0" href="{{ route('admin.districts.index') }}">
            {{ __('Districts') }}
        </a>
        @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.schools.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.schools.index'))
            {{ __('Schools') }}
            @else
            <a class="m-0 p-0" href="{{ route('admin.schools.index') }}">
                {{ __('Schools') }}
            </a>
        </li>
        @endif
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.studios.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.studios.index'))
            {{ __('Studios') }}
            @else
            <a class="m-0 p-0" href="{{ route('admin.studios.index') }}">
                {{ __('Studios') }}
            </a>
            @endif
        </li>
        <li class="m-0 p-4 inline-block border-zinc-300 border border-b-0 rounded-t-xl relative
            @if (request()->routeIs('admin.users.index')) bg-neutral-100 font-bold @endif ">
            @if (request()->routeIs('admin.users.index'))
            {{ __('Users') }}
            @else
            <a class="m-0 p-0" href="{{ route('admin.users.index') }}">
                {{ __('Users') }}
            </a>
            @endif
        </li>
    </ul>
</div>
