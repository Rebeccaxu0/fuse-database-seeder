@props(['title' => ''])

<x-layout :title="$title ? 'Admin - ' . $title : ''" >

  <div class="min-h-screen bg-gray-100">
    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white shadow">
      <div class="text-fuse-dk-teal text-2xl font-semibold font-display
                  max-w-7xl mx-auto
                  py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
      <article class="mx-auto my-auto py-16
                      min-w-screen min-h-screen">
        <div class="mx-auto
                    p-8 sm:px-12
                    w-2/3 lg:w-2/3
                    bg-gradient-to-t from-fuse-teal-100 to-white
                    border rounded-lg
                    shadow-lg">
          {{ $slot }}
        </div>
      </article>
    </main>
  </div>

</x-layout>
