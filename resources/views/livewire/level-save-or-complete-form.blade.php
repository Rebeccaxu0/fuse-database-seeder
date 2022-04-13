@push('scripts')
<script>
  document.getElementById('js_notice').hidden = true;
</script>
@endpush

<form method="POST" action="{{ route('student.save_artifact') }}"
  class="bg-slate-100 rounded-xl">
  @csrf
  <button id="close-btn" class="float-right"><x-icon icon="x-circle" /></button>
  <div class="w-full mb-2 p-2">
    <div id="js_notice" class="text-red-500">
      {{ __('Javascript required for file upload.') }}
    </div>
    <livewire:upload-code />
    <label for="url">{{ __('URL') }}</label>
    <input id="url" name="url" placeholder="{{ __('e.g. https://www.duckduckgo.com') }}">
  </div>
  <label for="name">{{ ('Name (optional)') }}</label>
  <input id="name" name="name" placeholder="{{ __('Name your artifact if you want') }}">
  <label for="notes">{{ ('Notes (optional)') }}</label>
  <textarea id="notes" name="notes" class="block"></textarea>
  <input type="radio" id="save_type" name="type" value="save" checked>
  <label for="save_type">{{ __("I'm just saving") }}</label>
  <input type="radio" id="complete_type" name="type" value="complete">
  <label for="complete_type">{{ __("I'm completing") }}</label>
  <div class="text-right">
    <button class="btn bg-fuse-green text-white uppercase">{{ __('Submit') }}</button>
  </div>
</form>

