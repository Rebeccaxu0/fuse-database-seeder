<div class="inline">
    @if ($create)
        @if ($levelPage)
        <button wire:click="$set('showModalFlag', true)"
                class="p-4 bg-white border shadow rounded-xl text-fuse-teal-dk text-4xl text-center">
            <x-icon icon="idea-new" width="150" height="150"
                fill="currentColor"
                alt="{{ __('New Idea') }}" />
                {{ __('Create your own!') }}
        </button>
        @else
        <button wire:click="$set('showModalFlag', true)"
                class="p-4 bg-white border shadow rounded-xl text-fuse-teal-dk text-4xl text-center">
            <x-icon icon="idea-new" width="150" height="150"
                fill="currentColor"
                alt="{{ __('New Idea') }}" />
        </button>
        @endif
    @else
    <button wire:click="$set('showModalFlag', true)">
        <x-icon icon="edit" class="inline" alt="{{ __('Edit Idea') }}" />
    </button>
    @endif
    <x-jet-modal wire:model="showModalFlag">
        <form wire:submit.prevent="submit" class="p-4">
            <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
                <button class="absolute right-0 top-0 m-2" wire:click="$set('showModalFlag', false)">
                    <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
                </button>
            </div>

            <div class="mx-4 mb-4 text-3xl text-fuse-teal-dk text-center font-semibold">
                {{ $title }}
            </div>

            <label for="idea" class="font-bold block">{{ __('My Idea') }} *
                @error('idea') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>
            <textarea wire:model="body" id="idea" class="w-full" placeholder="{!! __('I want to&hellip;') !!}"></textarea>

            <label for="name" class="font-bold block">{{ __('Short title') }} *
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>
            <input type="text" wire:model="name" id="name" class="w-full" placeholder="{{ __('3-4 words') }}">

            <fieldset>
                <label for="inspirations" class="font-bold block">
                    {{ __('Inspiration: ') }}
                    @foreach ($inspirationNames as $challengeName)
                    <span class='bg-white border rounded px-1 mx-1'>
                        {{ $challengeName }}
                    </span>
                    @endforeach
                </label>
                    <div class="border grid gap-2 md:grid-cols-2 max-h-16 overflow-y-scroll">
                        @foreach ($challengeVersions as $cv)
                        <div class="">
                            <label class="p-0">
                                <input class="hidden" name="inspirations[]" type="checkbox" wire:model="inspirations" value="{{ $cv->id }}"/>
                                <span>
                                    {{ $cv->name }}
                                </span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                <div>
                    <label for="team" class="font-bold block">{{ __('Team: ') }}
                    @foreach ($teamNames as $name)
                    <span class='bg-white border rounded px-1 mx-1'>
                        {{ $name }}
                    </span>
                    @endforeach
                    </label>
                    <div class="border grid gap-2 md:grid-cols-2 max-h-16 overflow-y-scroll">
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
            </fieldset>

            <button type="submit" class="btn float-right">{{ $actionButtonText }}</button>

        </form>
        </x-jetmodal>
</div>

