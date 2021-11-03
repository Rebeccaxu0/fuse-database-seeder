<x-guest-layout>
<article>
    <div class="mx-auto my-auto py-16">
    <div class="min-w-screen min-h-screen">
        <div>
            <div class="lg:flex mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
            <div class="lg:flex-1">
            <h2 class="mt-6 text-fuse-dk-teal text-2xl font-semibold font-display">Packages</h2>
            <div class="overflow-x-auto">
            <table class="table w-full table-zebra">
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <h4> {{$item->name}} </h4>
                        <label> {{$item->description}} </label>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>
</article>
</x-guest-layout>

