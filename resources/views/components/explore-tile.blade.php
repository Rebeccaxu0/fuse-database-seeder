<div {{ $attributes->merge(['class' => 'flex flex-col p-2 items-center justify-center bg-gradient-to-t from-fuse-teal to-fuse-teal-dk']) }}>
  <div class="text-white">
    {!! __('You have tried <span class="text-xl font-bold">:started/:total</span> challenges', ['started' => $started, 'total' => $total]) !!}
  </div>
    <a class="btn block w-full text-center bg-white text-black"
      href="{{ route('student.challenges') }}">
        Explore
    </a>
</div>
