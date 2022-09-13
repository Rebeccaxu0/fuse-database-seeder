@pushOnce('scripts')
{{-- <script src="//static.filestackapi.com/filestack-js/3.x.x/filestack.min.js"></script> --}}
<script src="/js/filestack.min.js"></script>
@endPushOnce

@push('scripts')
<script>
    let filestack_init = function() {
        const client = filestack.init('{{ env('FILESTACK_API_KEY') }}');

        let options = @js($pickerOptions);
        options.onUploadDone = (res) => Livewire.emit('filestackUploadComplete', res);

        picker = client.picker(options);
        picker.open();
    };
    document.addEventListener("DOMContentLoaded", () => {
            Livewire.on('fsPickerInit', () => { filestack_init(); });
    });
</script>
@endpush

<div id="Filestack-container" class="@if ($hidden) hidden @endif h-full">
    <div x-init="filestack_init()" id="Filestack-Picker" class="mb-4 aspect-[4/3] mx-auto @if ($preview) hidden @endif" style="height: 300px;"></div>
</div>
