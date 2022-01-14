<x-admin-layout>

    <x-slot name="title">{{ __('Create School') }}</x-slot>

    <x-slot name="header">{{ __('Create School') }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.schools.store') }}" method="POST">
        @csrf
        <x-form.input label="School Name" name="name" required="true" />
        <x-form.dropdown label="Package" name="package" :value="old('package')" :list="$packages" />
        <x-form.input label="Salesforce Account ID" name="salesforce_acct_id" />
        <label class="text-gray-700 mb-4">Parent Organization</label>
        <div>
            @livewire('add-district')
        </div>
        <div id="partner">
            <label class="text-gray-700 mb-4">Partnerships</label>
            @foreach (\App\Models\Partner::all() as $partner)
                <x-form.exclusive_checkbox_array name="partner" :value="$partner->id" :label="$partner->name" />
            @endforeach
        </div>
        <br />
        <label class="text-gray-700 mb-4">Grade Levels</label>
        @foreach (\App\Models\GradeLevel::all() as $glevel)
            <x-form.checkbox_array name="gradelevels" :value="$glevel->id" :label="$glevel->name" />
        @endforeach
        <br />
        <x-form.checkbox label="Active Studio License" name="license_status" :checked="old('license_status', 0)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Save School
            </button>
        </div>
    </form>
</x-admin-layout>