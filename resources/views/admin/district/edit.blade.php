<x-app-layout>

    <x-slot name="title">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

    <form class="mt-6" action="{{ route('admin.districts.update', $district) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $district->name)" />
        <div class="grid md:grid-cols-2 gap-x-4">
            <div>
                <x-form.dropdown label="Package" name="package" :value="old('package', $district->package_id)"
                    :list="$packages" />
            </div>
            <div>
                <x-form.input label="Salesforce Account ID" name="salesforce_acct_id"
                    :value="old('salesforce_acct_id', $district->salesforce_acct_id)" />
            </div>
        </div>
        <div class="mb-4">
            <span class="text-gray-700 mb-4">{{ __('Current Super Facilitators') }}</span>
            <p class="text-xs">{{ __('Mark for removal') }}</p>
            @foreach ($district->superFacilitators as $user)
                <x-form.checkbox_array name="superFacilitatorsToRemove" :value="$user->id" :label="$user->name" />
            @endforeach
        </div>
        <p class="text-xs">{{ __('Search to add') }}</p>
        <div>
            @livewire('add-super-facilitator')
        </div>
        <div class="mb-4">
            <span class="text-gray-700 mb-4">{{ __('Current Schools') }}</span>
            <p class="text-xs">{{ __('Mark for removal') }}</p>
            <div class="grid gap-x-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($district->schools as $school)
                    <x-form.checkbox_array name="schoolsToRemove" :value="$school->id" :label="$school->name" />
                @endforeach
            </div>
        </div>
        <p class="text-bold text-xs">{{ __('Search to add') }}</p>
        <div>
            @livewire('add-school')
        </div>
        <div x-data="{active: true}">
            <input type="checkbox" id="license_status" name="license_status" x-model="active" onclick="checkBoxes()">
            <span class="mx-2 text-gray-700">{{ __('Active Studio License') }}</span><br>
            <span
                class="mx-2 text-xs text-gray-700">{{__('Unchecking this will deactivate all schools in the district and move all associated students/facilitators into the Alumni Studio.') }}</span><br>
            <input type="checkbox" id="anonymize" name="anonymize" :disabled="active">
            <span class="mx-2 text-gray-700"
                :class="{ 'text-gray-400': active}">{{ __('Anonymize studio members') }}</span><br>
            <span class="mx-2 text-xs text-gray-700 " :class="{ 'text-gray-400': active}"> WARNING: This is a
                destructive operation and cannot be undone. </span><br>
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{__('Update District') }}</button>
        </div>
    </form>
    <!-- <form id="delete-frm" class="" action="{{ route('admin.districts.destroy', $district) }}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger">Delete</button>
    </form> -->

    <script>
        function checkBoxes() {
            if ($('#license_status').is(":checked")) $('#anonymize').prop("disabled", true).prop("checked", false);
        }
    </script>
</x-app-layout>
