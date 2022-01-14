<x-admin-layout>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.districts.store') }}" method="POST">
        @csrf
        <x-form.input label="Name" name="name" required="true" />
        <x-form.dropdown label="Package" name="package" :value="old('package')" :list="$packages" />
        <x-form.input label="Salesforce Account ID" name="salesforce_acct_id" />
        <x-form.checkbox label="Active Studio License" name="license_status" :checked="old('license_status', 0)" />
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                Create District
            </button>
        </div>
    </form>

</x-admin-layout>
