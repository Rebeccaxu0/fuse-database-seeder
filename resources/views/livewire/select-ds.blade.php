<div class="relative">
    @livewire ('school-district-search-bar')

    @foreach ($selectedschools as $id => $school)
        <div>
            <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ }}
        </div>
    @endforeach
</div>
