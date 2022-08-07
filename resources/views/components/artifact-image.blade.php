<div {{ $attributes->merge(
    ['class' => ($preview ? 'overflow-hidden aspect-video ' : 'w-full h-full ')
     . 'relative bg-gradient-to-t from-fuse-teal-dk to-fuse-teal']) }} >
    @if ($aggregate_type == 'video' || $aggregate_type == 'audio')
    <video class="video-js vjs-default-skin" width="100%" height="300px" data-setup="{}"
     @if (! $preview) controls @endif >
        <source src="{{ $imageUrl }}" type="{{ $mime }}">
            <p class="vjs-no-js">
                To view this video please enable JavaScript and consider upgrading to a web browser that
                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
    </video>
    @if ($preview && $iconUrl)
        <div class="absolute inset-0 flex items-center justify-center">
        <img src="{{ $iconUrl }}" class="h-1/3"/>
        </div>
    @endif
    @else
        @if ($preview)
        <div class="bg-cover h-full w-full" style="background-image: url({{ $imageUrl }})" ></div>
        @else
        <img class="mx-auto" src="{{ $imageUrl }}" />
        @endif

        <div class="absolute inset-0 flex items-center justify-center
        @if ($needsScrim) bg-fuse-teal-dk bg-opacity-70 @endif ">
        @if ($iconUrl)
            <img src="{{ $iconUrl }}" class="h-1/3"/>
        @endif
        </div>
    @endif
</div>

{{-- <span class='text-sm'>{{ $artifact->id }}</span>
<span class='text-sm'>{{ $preview }}</span>
<span class='text-sm'>{{ $aggregate_type }}</span>
<span class='text-sm'>{{ $filestackHandle }}</span> --}}
