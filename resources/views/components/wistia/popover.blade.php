@props(['videoId', 'thumbnail' => false, 'responsive' => true])

@pushOnce('scripts')
<script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
@endPushOnce

@push('scripts')
<script src="https://fast.wistia.com/embed/medias/{{ $videoId }}.jsonp" async></script>
@endPush

@if ($thumbnail)
    @if ($responsive)
<div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><span class="wistia_embed wistia_async_{{ $videoId }} popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span></div></div>
    @else
<span class="wistia_embed wistia_async_{{ $videoId }} popover=true popoverAnimateThumbnail=true" style="display:inline-block;height:84px;position:relative;width:150px">&nbsp;</span>
    @endif
@else
<span class="wistia_embed wistia_async_{{ $videoId }} popover=true popoverContent=link" style="display:inline;position:relative"><a href="#">{{ $slot }}</a></span>
@endif

