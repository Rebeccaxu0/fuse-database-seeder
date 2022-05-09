<ul {{ $attributes->merge(['class' => 'hidden md:flex flex-col md:flex-row justify-between md:h-full']) }}>
    {{ $slot }}
</ul>
