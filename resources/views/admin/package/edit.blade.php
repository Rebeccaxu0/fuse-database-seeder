@php
    use App\Enums\ChallengeStatus as Status;
@endphp

<x-app-layout>

    <x-slot name="title">Edit Package {{ $package->name }}</x-slot>

    <x-slot name="header">Edit Package {{ $package->name }}</x-slot>

    <form id="delete-frm" action="{{ route('admin.packages.destroy', $package) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="float-right bg-red-500">Delete Package</button>
    </form>
    <form class="mt-6" action="{{ route('admin.packages.update', $package) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name"
                      name="name"
                      required="true"
                      :value="old('name', $package->name)" />
        <x-form.textarea name="description"
                         label="Description"
                         :value="old('description', $package->description)" />
        <x-form.checkbox label="Access to Student Activity Tab"
                         name="student_activity_tab_access"
                         :checked="old('student_activity_tab_access', $package->student_activity_tab_access)" />
        <fieldset class="border border-black rounded p-2">
            <legend class="mb-2 text-gray-700 form-required">
            Allowed Challenges
            </legend>
            <h3 class="m-0">{{ Status::Beta->label() }}</h3>
            <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4">
                @foreach ($betaChallenges as $challenge)
                    <x-form.checkbox_array name="challenges"
                                        :label="$challenge->name"
                                        :value="$challenge->id"
                                        :active="$package->challenges()->find($challenge->id)" />
                @endforeach
            </div>
            <h3 class="m-0 mt-4">{{ Status::Current->label() }}</h3>
            <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4">
                @foreach ($challenges as $challenge)
                    <x-form.checkbox_array name="challenges"
                                        :label="$challenge->name"
                                        :value="$challenge->id"
                                        :active="$package->challenges()->find($challenge->id)" />
                @endforeach
            </div>
            <h3 class="m-0 mt-4">{{ Status::Legacy->label() }}</h3>
            <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 sm:gap-4">
                @foreach ($legacyChallenges as $challenge)
                    <x-form.checkbox_array name="challenges"
                                        :label="$challenge->name"
                                        :value="$challenge->id"
                                        :active="$package->challenges()->find($challenge->id)" />
                @endforeach
            </div>
        </fieldset>

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                id="btn-submit">Save Package </button>
        </div>

    </form>

</x-app-layout>

