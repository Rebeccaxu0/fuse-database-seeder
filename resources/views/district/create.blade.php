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
                name="name"
                required="true" />
            <div class="mb-2">
                <label class="text-gray-700 mb-2 form-required">Package</label>
              </div>
              <x-form.dropdown>
                @foreach($packages as $package)
                <option> {{$package->name}} </option>
                @endforeach
            </x-form.dropdown>
            <x-form.input
                name="Salesforce Account ID"/>
            <x-form.checkbox
                name="active_studio_license"
                label="Active Studio License"
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
