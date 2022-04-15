<div>
    {{ __('I worked with: ') }}
    @foreach ($teamNames as $name)
    <span class='bg-white border rounded px-1 mx-1'>
        {{ $name }}
    </span>
    @endforeach
    <div class="grid gap-2 md:grid-cols-2">
        @foreach ($studioMembers as $student)
        <div class="">
            <label class="p-0">
                <input class="hidden" name="teammates[]" type="checkbox" wire:model="teammates" value="{{ $student->id }}"/>
                <span>
                    {{ $student->full_name }} ({{ $student->name }})
                </span>
            </label>
        </div>
        @endforeach
    </div>
</div>
