<x-app-layout>

    <x-slot name="title">{{ __('Edit :name', ['name' => $studio->name]) }}</x-slot>

    <x-slot name="header">{{ __('Edit :name', ['name' => $studio->name]) }}</x-slot>

    <form action="{{ route('admin.studios.update', $studio) }}" method="POST">
        @method('PATCH')
        @csrf
        <x-form.input label="Name" name="name" required="true" :value="old('name', $studio->name)" />
        <x-form.defaultdropdown label="Package" name="package" value="old('package', $studio->package_id)"
                :inherited="$studio->school->deFactoPackage" 
                :list="$packages" />
        <livewire:facilitator.studio-code :studio="$studio">
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">{{
              __(' Update Studio')
              }}</button>
        </div>
    </form>
</x-app-layout>