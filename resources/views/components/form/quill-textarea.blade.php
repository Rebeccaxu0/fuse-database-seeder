@pushOnce('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endPushOnce

@pushOnce('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    quill = Object();
</script>
@endPushOnce

<div x-data x-id="['quill-data', 'quill-editor']" class="mt-8">
  <!-- Hidden input for form submission (request parameter) -->
  <input type="hidden" :id="$id('quill-data')" name="{{ $name }}">

  <span class="text-gray-700 mb-2">{{ $label }}</span>
  @if ($sublabel)
  <span class="text-gray-700 text-xs mb-2">{{ $sublabel }}</span>
  @endif

  {{-- <div id="{{ $name . '-editor' }}">{!! $old !!}</div> --}}
  <div
       x-data
       :id="$id('quill-editor')"
       x-init="
         toolbarOptions = ['bold', 'italic', 'underline', 'link'];
         options = {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
         };
         quill[$id('quill-editor')] = new Quill($el, options);
         quill[$id('quill-editor')].on('text-change', function (delta, oldContents, source) {
            document.getElementById($id('quill-data')).value = quill[$id('quill-editor')].root.innerHTML;
         });
         document.getElementById($id('quill-data')).value = quill[$id('quill-editor')].root.innerHTML;
       "
  >
  {!! $old !!}
  </div>
</div>
