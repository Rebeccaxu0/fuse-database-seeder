@if ($studio->dashboard_message || Auth::user()->can('updateDashboardMessage', $studio))
<div {{ $attributes->merge() }}>
    <div class="rounded-xl bg-white shadow px-4 py-2 min-h-[3rem]">
        @can('updateDashboardMessage', $studio)
            <livewire:facilitator.studio-dashboard-message :studio="$studio" >
        @else
            {!! $studio->dashboard_message !!}
        @endcan
    </div>
</div>
@endif
