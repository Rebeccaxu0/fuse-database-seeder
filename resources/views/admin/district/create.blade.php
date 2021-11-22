<x-app-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="container rounded mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="rounded mt-5 pl-4 pr-4 pt-4 pb-4">
            <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">Create District</h2>
            <form class="w-full max-w-lg mt-6" action="{{ route('admin.districts.store') }}" method="POST">
              @csrf
              <x-form.input
                label="Name"
                name="name"
                required="true"/>
              <x-form.dropdown
                label="Package"
                name="package"
                :value="old('package')"
                :list="$packages"/>
              <x-form.input
                label="Salesforce Account ID"
                name="salesforce_acct_id"/>
              <x-form.checkbox
                label="Active Studio License"
                name="active_studio_license"
                :checked="old('status', 0)"/>
              <div class="flex flex-wrap mt-4 -mx-3 mb-2">
                <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                  Create District
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </article>
</x-app-layout>
