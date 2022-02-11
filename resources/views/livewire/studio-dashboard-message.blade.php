@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush

<div class="mt-2 bg-white" wire:ignore>
  <div
       x-data
       x-ref="quillEditor"
       x-init="
         options = {
            debug: 'info',
            theme: 'snow'
         };
         quill = new Quill($refs.quillEditor, options);
         quill.on('text-change', function () {
           $dispatch('quill-input', quill.root.innerHTML);
         });
       "
       x-on:quill-input.debounce.1000ms="@this.set('studio.dashboard_message', $event.detail)"
  >
  {!! $studio->dashboard_message !!}
  </div>
</div>

