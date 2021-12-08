<x-admin-layout>

  <x-slot name="title">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

  <x-slot name="header">{{ __('Edit District :name', ['name' => $district->name]) }}</x-slot>

  <form class="w-full max-w-lg mt-6" action="{{ route('admin.districts.update', $district)}}" method="POST">
    @method('PATCH')
    @csrf
    <x-form.input label="Name" name="name" required="true"
                  :value="old('name', $district->name)"/>
    <x-form.dropdown label="Package" name="package"
                     :value="old('package', $district->package_id)"
                     :list="$packages"/>
    <x-form.input label="Salesforce Account ID"
                  name="salesforce_acct_id"
                  :value="old('salesforce_acct_id', $district->salesforce_acct_id)"/>
    <x-form.checkbox label="Active Studio License"
                     name="license_status"
                     :checked="old('license_status', $district->license_status)"/>
    <div class="mb-4">
      <label class="text-gray-700 mb-4">Current Schools</label>
      <p class="text-bold text-xs"> Mark for removal</p>
    </div>
    @foreach($district->schools as $school)
    <x-form.checkbox_array name="schoolsremove"
                           :value="$school->id"
                           :label="$school->name" />
    @endforeach
    <div class="mb-4">
      <label class="text-gray-700 mb-4">Current Super Facilitators</label>
      <p class="text-bold text-xs"> Mark for removal</p>
    @foreach($district->superFacilitators as $user)
    <x-form.checkbox_array name="facilitatorsremove"
                           :value="$user->id"
                           :label="$user->name" />
    @endforeach
    </div>
    <div>
      @livewire('user-search-bar', ['district' => $district])
    </div>
    <div class="flex flex-wrap mt-4 -mx-3 mb-2">
      <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
        Update District
      </button>
    </div>
  </form>
  <!-- <form id="delete-frm" class="" action="{{ route('admin.districts.destroy', $district)}}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger">Delete</button>
    </form> -->

</x-admin-layout>
