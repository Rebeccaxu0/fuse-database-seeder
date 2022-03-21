@props(['videoId'])

@pushOnce('scripts')
<script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
@endPushOnce

@push('scripts')
<script src="https://fast.wistia.com/embed/medias/{{ $videoId }}.jsonp" async></script>
@endPush

<div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
    <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
        <div class="wistia_embed wistia_async_{{ $videoId }} seo=false videoFoam=true" style="height:100%;position:relative;width:100%"></div>
    </div>
</div>