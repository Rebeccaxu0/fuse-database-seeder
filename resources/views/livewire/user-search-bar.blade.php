
<div class="relative">
    <input
        type="text"
        class="form-input mt-1 block w-full rounded"
        placeholder="Search facilitators..."
        wire:model="query"
    />
 
    <div wire:loading class="absolute z-10 w-full bg-white shadow-lg list-group">
        <div class="list-item">Searching...</div>
    </div>
 
    @if(!empty($query))
        <div class="fixed top-0 bottom-0 left-0 right-0"></div>
 
        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            @if(!empty($users))
                @foreach($users as $i => $user)
                <span wire:click.prevent="selectUser"> 
                    {{$user->name}}
                </span>
                @endforeach
            @else
                <div class="list-item bg-white shadow-lg list-group">No results</div>
            @endif
        </div>
    @endif
</div>
