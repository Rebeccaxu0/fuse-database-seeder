@if ($studio->dashboard_message || Auth::user()->can('updateDashboardMessage', $studio))
<div {{ $attributes->merge() }}>
    <h2 class="text-left">
        {{ __('Studio Notes') }}
    </h2>
    <div class="border-solid border-black border-2 min-h-[3rem]">
        @can('updateDashboardMessage', $studio)
            @if ($studio->dashboard_message)
                <a class="block" href="{{ route('facilitator.settings') }}">
                    {{ __('edit') }}
                </a>
            @else
                <a href="{{ route('facilitator.settings') }}">
                    {{ __('Click to add a note here') }}
                </a>
            @endif
        @endcan
        {!! $studio->dashboard_message !!}
    </div>
</div>
@endif
