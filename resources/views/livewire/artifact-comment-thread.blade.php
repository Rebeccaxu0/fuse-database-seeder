<div class="border-l p-2 float-right height-full">
    <div class="max-h-48 overflow-scroll">
        @foreach ($comments as $comment)
        <div>
            <x-avatar id="profile-pic" :user="$comment->user" class="h-8 w-8 border-white border-2"/>
                <span class="font-bold">{{ $comment->user->full_name }}:</span> {{ $comment->body }}
        </div>
        @endforeach
    </div>
    <div class="uppercase font-medium text-lg">{{ __('Add Comment') }}</div>
    <textarea wire:model="newComment" id="comment" name="comment" placeholder="{{ __('Write your comment here...') }}"></textarea>
    <button wire:click="submit" class="btn">{{ __('Save') }}</button>
</div>
