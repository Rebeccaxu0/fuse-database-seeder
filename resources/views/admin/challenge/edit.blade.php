<x-app-layout>

    <x-slot name="title">{{ __('Edit Challenge :name', ['name' => $challenge->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit Challenge :name', ['name' => $challenge->name]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.challenges.update', $challenge) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $challenge->name)" />
        <x-form.textarea name="description">{{ old('description', '') }}</x-form.textarea>
        
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Update Challenge') }}</button>
        </div>
    </form>
    <script>
        function checkBoxes() {
            if ($('#license_status').is(":checked")) $('#anonymize').prop("disabled", true).prop("checked", false);
        }
    </script>
</x-app-layout>
