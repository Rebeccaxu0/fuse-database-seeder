<x-admin-layout>

    <x-slot name="title">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.districts.update', $district) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $district->name)" />
        <x-form.dropdown label="Package" name="package" :value="old('package', $district->package_id)"
            :list="$packages" />
        <x-form.input label="Salesforce Account ID" name="salesforce_acct_id"
            :value="old('salesforce_acct_id', $district->salesforce_acct_id)" />
        <div class="mb-4">
            <label class="text-gray-700 mb-4">Current Super Facilitators</label>
            <p class="text-xs"> Mark for removal</p>
            @foreach ($district->superFacilitators as $user)
                <x-form.checkbox_array name="superFacilitatorsToRemove" :value="$user->id" :label="$user->name" />
            @endforeach
        </div>
        <p class="text-xs"> Search to add</p>
        <div>
            @livewire('add-super-facilitator')
        </div>
        <div class="mb-4">
            <label class="text-gray-700 mb-4">Current Schools</label>
            <p class="text-xs"> Mark for removal</p>
            @foreach ($district->schools as $school)
                <x-form.checkbox_array name="schoolsToRemove" :value="$school->id" :label="$school->name" />
            @endforeach
        </div>
        <p class="text-bold text-xs"> Search to add</p>
        <div>
            @livewire('add-school')
        </div>
        <div x-data="{active: true}">
            <input type="checkbox" id="license_status" name="license_status" x-model="active" onclick="checkBoxes()">
            <span class="mx-2 text-gray-700"> Active Studio License </span><br>
            <span class="mx-2 text-xs text-gray-700"> Unchecking this will deactivate all schools in the district and
                move all associated students/facilitators into the Alumni Studio. </span><br>
            <input type="checkbox" id="anonymize" name="anonymize" :disabled="active">
            <span class="mx-2 text-gray-700" :class="{ 'text-gray-400': active}"> Anonymize studio members </span><br>
            <span class="mx-2 text-xs text-gray-700 " :class="{ 'text-gray-400': active}"> WARNING: This is a
                destructive operation and cannot be undone. </span><br>
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Update District
            </button>
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
</x-admin-layout>
