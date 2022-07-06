<x-app-layout>

    <x-slot name="title">LTI PLatforms</x-slot>

    <x-slot name="header">LTI PLatforms</x-slot>

    <a href="{{ route('admin.ltiplatforms.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add platform</button>
    </a>
    @foreach ($lti_platforms as $lti)
        <h3 class="mt-2 mb-2">{{ $lti->client_id }}
            <span class="pl-2">
                <a href="{{ route('admin.ltiplatforms.edit', $lti) }}">
                    <button><x-icon icon="edit" width=25 height=25 class="ml-2 text-black" /></button>
                </a>
                <form method="post" action="{{ route('admin.ltiplatforms.destroy', $lti) }}"
                    class="inline-block">
                    @method('delete')
                    @csrf
                        <button><x-icon icon="trash" width=25 height=25 class="ml-2 text-black" /></button>
                </form>
            </span>
        </h3>
    @endforeach

</x-app-layout>
