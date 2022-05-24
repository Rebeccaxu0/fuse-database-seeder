<x-app-layout>

    <x-slot name="title">{{ __('Edit Announcement') }}</x-slot>

    <x-slot name="header">{{ __('Edit Announcement') }}</x-slot>

    <form class="mt-6" action="{{ route('admin.announcements.update', ['announcement' => $announcement]) }}" method="POST">
        @csrf
        @method('PATCH')
        <fieldset class="border border-black p-2">
            <legend>{{ __('Announcement Type *') }}</legend>
            @error('type')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
            <div class="flex">
                <div class="mr-4">
                    <input type="radio"
                           id="newtype"
                           name="type"
                           value="new"
                           required
                           @if ('new' == old('type', $announcement->type)) checked @endif>
                    <label for="newtype" class="py-1 px-3 text-white rounded-xl announcement-tag new">{{ __('New') }}</label>
                </div>
                <div class="mr-4">
                    <input type="radio"
                           id="updatetype"
                           name="type"
                           value="update"
                           required
                           @if ('update' == old('type', $announcement->type)) checked @endif>
                    <label for="updatetype" class="py-1 px-3 text-white rounded-xl announcement-tag update">{{ __('Update') }}</label>
                </div>
                <div class="mr-4">
                    <input type="radio"
                           id="alerttype"
                           name="type"
                           value="alert"
                           required
                           @if ('alert' == old('type', $announcement->type)) checked @endif>
                    <label for="alerttype" class="py-1 px-3 text-white rounded-xl announcement-tag alert">{{ __('Alert') }}</label>
                </div>
            </div>
        </fieldset>

        <div class="flex gap-4 mt-2">
            <div class="flex-1">
                <label for="start_at">{{ __('Start Date/Time *') }}</label>
                <input type="datetime-local"
                       id="start_at"
                       name="start_at"
                       value="{{ old('start_at', date('Y-m-d\TH:i', strtotime($announcement->start_at))) }}"
                       pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"
                       required
                       >
                @error('start_at')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex-1">
                <label for="end_at">{{ __('End Date/Time *') }}</label>
                <input type="datetime-local"
                       id="end_at"
                       name="end_at"
                       min="{{ $now }}"
                       value="{{ old('end_at', date('Y-m-d\TH:i', strtotime($announcement->end_at))) }}"
                       pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"
                       required
                       >
                @error('end_at')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="mt-2 block" for="url">{{ __('URL (optional)') }}</label>
            <input type="text" id="url" name="url" value="{{ old('url', $announcement->url) }}">
            @error('url')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <x-form.textarea label="{{ __('Message *') }}" name="message" :value="old('message', $announcement->body)" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                id="btn-submit">{{ __('Save Announcement') }}</button>
        </div>
    </form>

</x-app-layout>

