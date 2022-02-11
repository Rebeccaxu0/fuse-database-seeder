<div>
    <form wire:submit.prevent="submit">
        <textarea wire:model.defer="studio.dashboard_message">
        </textarea>
        <button wire:click="submit" type="submit">{{ __('Save Message') }}</button>
    </form>
</div>
