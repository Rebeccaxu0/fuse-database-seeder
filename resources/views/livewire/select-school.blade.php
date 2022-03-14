<div class="relative">
    @livewire ('school-search-bar')

    @foreach ($selectedschools as $id => $school)
        <div>
            <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ $school['name'] }}
        </div>
    @endforeach
</div>
