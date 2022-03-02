<div class="mt-8">
    <span>
        {{ __('Add Student by Search') }}
    </span>
    <input wire:model.debounce.300ms="search" type="text" class="form-input mt-1 block w-full rounded"
        placeholder="Search for student by name/email/etc&hellip;" value="{{ $search }}" />
    <div wire:loading class="absolute z-10 w-full bg-white shadow-lg">
        <div class="list-item">Searching...</div>
    </div>

    @if (!empty($search))
        <div class="absolute bg-white rounded-lg left-0 right-0">

            <div class="relative z-10 w-full bg-white rounded-t-none shadow-lg list-group">
                @if (count($students))
                    <ul>
                        @foreach ($students as $student)
                            <li class="mb-6 cursor-pointer" wire:click="add({{ $student }})">
                                {{ $student->full_name }}
                                @if ($student->email)
                                    &lt;{{ $student->email }}&gt;
                                @endif
                                ({{ $student->name }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div>No results</div>
                @endif
            </div>
        </div>
    @endif
</div>
