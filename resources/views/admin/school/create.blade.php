<x-app-layout>

    <x-slot name="title">{{ __('Create School') }}</x-slot>

    <x-slot name="header">{{ __('Create School') }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.schools.store') }}" method="POST">
        @csrf
        <x-form.input label="School Name" name="name" required="true" />
            <x-form.dropdown label="Package" name="package" :value="old('package')" :list="$packages" none_label="{{ __('Inherited from District') }}"/>

        <x-form.input label="Salesforce Account ID" name="salesforce_acct_id" />

        @error('district')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
        <label class="block mb-4">
            <span class="text-gray-700 font-bold">{{ __('District') }}</span>
            <select name="district">
                <option value="0">{{ __('--') }}</option>
                @foreach ($districts as $district)
                <option value="{{ $district->id }}"
                  @if ($district->id == old('district', $districtQueryValue)) selected @endif>
                  {{ $district->name }} ({{ $district->package ? $district->package->name : __('no package') }})</option>
                @endforeach
            </select>
        </label>

        <div>
            <span class="text-gray-700 mb-4 font-semibold">{{ __('Partnership:') }}</span>
            @foreach (\App\Models\Partner::all() as $partner)
                <x-form.exclusive_checkbox_array name="partner" :value="$partner->id" :label="$partner->name" />
            @endforeach
        </div>

        <div class="my-4">
            <span class="text-gray-700 font-semibold">{{ __('Grade Levels:') }}</span>
            @foreach (\App\Models\GradeLevel::all() as $grade_level)
            <x-form.checkbox_array name="gradelevels" :value="$grade_level->id" :label="$grade_level->name" />
                @endforeach
        </div>

        <x-form.checkbox label="Active Studio License" name="license_status" :checked="old('license_status')" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                {{ __('Save School') }}
            </button>
        </div>
    </form>
</x-app-layout>
