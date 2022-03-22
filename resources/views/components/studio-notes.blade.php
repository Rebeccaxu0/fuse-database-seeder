@if ($studio->dashboard_message || Auth::user()->can('updateDashboardMessage', $studio))
<div {{ $attributes->merge() }}>
    <h2 class="text-left">
        {{ __('Studio Notes') }}
    </h2>
    <div class="border-solid border-black border-2 min-h-[3rem]">
        @can('updateDashboardMessage', $studio)
            <livewire:facilitator.studio-dashboard-message :studio="$studio" >
        @else
            {!! $studio->dashboard_message !!}
        @endcan
    </div>
</div>
@endif
