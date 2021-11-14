<x-admin-layout>
  <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
    <div class="container rounded mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="rounded mt-5 pl-4 pr-4 pt-4 pb-4">
            <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">Create Package</h2>
            @if ($errors->any())
            <div class="bg-red-300 rounded border-2 border-red-500 p-4">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <form class="w-full max-w-lg mt-6" action="{{ route('admin.packages.store') }}" method="POST">
              @csrf
              <div class="flex flex-wrap -mx-3 mb-6">
                <label class="block">
                  <span class="text-gray-700 form-required">Title</span>
                  <span class="form-required" title="This field is required.">*</span>
                  <input type="text" name="name" class="form-input form-text-required mt-1 block w-full rounded" value="{{ old('name') }}">
                </label>
              </div>
              <div class="-mx-3 mb-6">
                <label class="block">
                  <span class="text-gray-700">Description</span>
                  <textarea class="form-textarea mt-1 block w-full rounded" name="description" rows="3">{{ old('description') }}</textarea>
                </label>
              </div>
              <div class="-mx-3 mb-6">
                <label class="block">
                  <input type="checkbox" class="form-checkbox" name="student_activity_tab_access" {{ old('student_activity_tab_access') == 'on' ? 'checked' : '' }}>
                  <span class="text-gray-700">Access to Student Activity Tab</span>
                </label>
              </div>
              <div class="-mx-3 mb-2">
                <label class="text-gray-700 mb-2 form-required">Allowed Challenges</label>
              </div>
              @foreach($challenges as $challenge)
              <div>
                <label class="inline-flex items-center mb-2">
                  <input type="checkbox" class="form-checkbox" name="challenges[]" value="{{ $challenge->id }}" {{ old('challenges') && in_array($challenge->id, old('challenges')) ? 'checked' : '' }}>
                  <span class="ml-2">{{ $challenge->name }}</span>
                </label>
              </div>
              @endforeach
              <div class="flex flex-wrap mt-4 -mx-3 mb-2">
                <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                  Create Package
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </article>
</x-admin-layout>
