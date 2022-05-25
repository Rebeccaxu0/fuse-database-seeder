<section {{ $attributes->merge(['class' => 'py-3 px-3 max-h-96 min-h-[12rem] sm:max-h-screen overflow-scroll']) }}>
    @foreach ($studentActivity as $activity)
        <x-student.activity-feed-card :activity="$activity" :studio="$studio" />
    @endforeach
</section>
