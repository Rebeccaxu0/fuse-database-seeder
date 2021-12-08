<div class="mt-1">
    <label class="inline-flex items-center">
		<input 
            type="checkbox" 
            value="{{ $user->id }}" 
            wire:model="selectedusers"  
            class="form-checkbox h-6 w-6 text-green-500">
            <span class="ml-3 text-sm">{{ $user->name }}</span>
    </label>
</div>

