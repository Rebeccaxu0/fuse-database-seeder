<x-app-layout>

    <x-slot name="title">{{ __('Edit :name', ['name' => $school->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit :name', ['name' => $school->name]) }}</x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.schools.update', $school) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $school->name)" />
        <div class="grid md:grid-cols-2 gap-x-4">
            <div>
                <x-form.defaultdropdown label="Package" name="package" :value="old('package', $school->package_id)"
                    :inherited="$school->district ? $school->district->package : null" :list="$packages" />
            </div>
            <div>
                <x-form.input label="Salesforce Account ID" name="salesforce_acct_id"
                    :value="old('salesforce_acct_id', $school->salesforce_acct_id)" />
            </div>
        </div>
        <x-form.dropdown label="District" name="district" :value="old('district', $school->district ? $school->district->id : null)"
            :list="$districts" />

        <fieldset class="grid gap-x-4 grid-cols-2 md:grid-cols-3 border p-2">
            <legend class="text-gray-700 font-bold">{{ __('Grade Levels') }}</legend>
            @foreach (\App\Models\GradeLevel::all()->sort() as $glevel)
                <x-form.checkbox_array name="gradelevels" :value="$glevel->id" :label="$glevel->name" />
            @endforeach
        </fieldset>

        <fieldset id="partners" class="grid gap-x-4 grid-cols-2 md:grid-cols-3 border p-2">
            <legend class="text-gray-700 font-bold">{{ __('Partnerships') }}</legend>
            @foreach (\App\Models\Partner::all()->sortBy('name') as $partner)
                <x-form.exclusive_checkbox_array name="partner" :value="$partner->id" :label="$partner->name" />
            @endforeach
        </fieldset>

        <fieldset class="border p-2">
            <legend class="text-gray-700 font-bold">{{ __('Facilitators') }}</legend>
            @if ($school->facilitators()->count() > 0)
                <div class="text-gray-700 mb-4">{{ __('Current Facilitators') }}</div>
                <div class="grid gap-x-4 grid-cols-2 md:grid-cols-3">
                    <p class="text-xs">{{ __('Mark for removal') }}</p>
                    @foreach ($school->facilitators as $facilitator)
                        <x-form.checkbox_array name="facilitatorsToRemove" :value="$facilitator->id"
                            :label="$facilitator->name" />
                    @endforeach
                </div>
            @endif

            <p class="text-xs">{{ __('Search to add') }}</p>
            <div>
                @livewire('add-facilitator')
            </div>
        </fieldset>

        <fieldset class="border p-2">
            <legend class="text-gray-700 font-bold">{{ __('Studios') }}</legend>
            @if ($school->studios()->count() > 0)
                <div class="text-gray-700 mb-4">
                    {{ __('Current Studios (:count)', ['count' => $school->studios()->count()]) }}</div>
                <p class="text-xs"> Mark for removal</p>
                <div class="grid gap-x-4 grid-cols-2 md:grid-cols-3">
                    @foreach ($school->studios as $studio)
                        <x-form.checkbox_array name="studiosToRemove" :value="$studio->id" :label="$studio->name" />
                    @endforeach
                </div>
            @endif
            <p class="text-xs">{{ __('Search to add') }}</p>
            <div>
                @livewire('add-studio')
            </div>
        </fieldset>

        <div x-data="{active: true}">
            <label class="text-gray-700 text-base block">
                <input class="mr-2" type="checkbox" value="1" id="license_status" name="license_status" x-model="active" onclick="checkBoxes()">
                {{ __('Active Studio Licenses') }}
            </label>
            <span
                class="mx-2 text-xs text-gray-700">{{ __('Unchecking this will deactivate all studios in the school and move all associated students/facilitators into the Alumni Studio.') }}</span><br>
            <input type="checkbox" id="anonymize" name="anonymize" :disabled="active">
            <span class="mx-2 text-gray-700"
                :class="{ 'text-gray-400': active}">{{ __('Anonymize studio members') }}</span><br>
            <span class="mx-2 text-xs text-gray-700"
                :class="{ 'text-gray-400': active}">{{ __('WARNING: This is a destructive operation and cannot be undone.') }}</span><br>
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{ __('Update School') }}</button>
        </div>
    </form>
    <!-- <form id="delete-frm" class="" action="{{ route('admin.schools.destroy', $school) }}" method="POST">
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
