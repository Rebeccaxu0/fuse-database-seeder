<div class="relative">
    <input
        type="search"
        class="form-input mt-1 block w-full rounded"
        placeholder="Search facilitators..."
        wire:model="query"
    />
    <div wire:loading class="absolute z-10 w-full bg-white shadow-lg list-group">
        <div class="list-item">Searching...</div>
    </div>
 
    @if(!empty($query))
        <div class="relative top-0 bottom-0 left-0 right-0"></div>
 
        <div class="relative z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            @if(!empty($users))
                @foreach($users as $user)
                <div class="mb-6">
                    <input type="checkbox" 
                            value="{{ $user->id }}" 
                            wire:model.defer="selectedusers.{{ $user->id }}"  
                            class="form-checkbox">
                            <span class="mx-2 text-gray-700">{{ $user->name }}</span>
                    </label>
                </div>
                @endforeach
            @else
                <div>No results</div>
            @endif
        </div>
    @endif
    <div class="relative">
        <button  type="button" class="text-xs" wire:click="addUsers"> Add facilitators</button>
    </div>
</div>
