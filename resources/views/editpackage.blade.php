<x-admin-layout>
    <article class="mx-auto my-auto py-16 min-w-screen min-h-screen">
        <div class="container rounded mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                        <h2 class="mt-6 text-fuse-dk-teal text-center text-2xl font-semibold font-display">Edit Package</h2>
                        <form class="w-full max-w-lg mt-6" action="/admin/editpackage" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <label class="block">
                                    <span class="text-gray-700 form-required">Title</span>
                                    <input type="text" name="title" class="form-input form-text-required mt-1 block w-full rounded" value="{{ $package->title }}">
                                </label>
                            </div>
                            <div class=" -mx-3 mb-6">
                                <label class="block">
                                    <span class="text-gray-700">Description</span>
                                    <textarea class="form-textarea mt-1 block w-full rounded" name="description" rows="3" value="{{ $package->description }}"></textarea>
                                </label>
                            </div>
                            <div class= "-mx-3 mb-2">
                                <label class="text-gray-700 mb-2 form-required">Allowed Challenges</label>
                            </div>
                            @foreach($challenges as $item)
                            <div>
                            <label class="inline-flex items-center mb-2">
                                <input type="checkbox" class="form-checkbox">
                                <span class="ml-2" name="chal[]">{{ $item->name }}</span>
                            </label>
                            </div>
                            @endforeach
                            <div class="flex flex-wrap mt-4 -mx-3 mb-2">
                                <label class="block">
                                    <span class="text-gray-700">Author</span>
                                    <input type="text" class="form-input mt-1 block w-full rounded" id="author" value="user">
                                </label>
                            </div>
                            <div class="flex flex-wrap mt-4 -mx-3 mb-2">
                                <button type="submit" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                                    Save
                                </button>
                            </div>
                            <form id="delete-frm" class="" action="/admin/editpackage" method="POST">
                                @method('DELETE')
                                 @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</x-admin-layout>



<form action="/foo/bar" method="POST">
    @method('DELETE')

    ...
</form>