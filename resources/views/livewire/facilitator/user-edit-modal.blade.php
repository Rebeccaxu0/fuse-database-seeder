<div class="inline-block h-full">
    <button
      wire:click="$set('showEditModal', true)"
      alt="{{ __('Edit') }}"
      title="{{ __('Edit') }}"
      class="py-2 px-5 h-full
             border-fuse-teal-dk border {{ $user->isFacilitator() ? 'rounded-xl' : 'rounded-l-xl' }}
             text-fuse-teal-dk hover:text-white hover:bg-fuse-green-900
             text-white text-center inline-block">{{
      __('Edit')
      }}</button>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">
              {{ __('Edit :full_name (:name)', ['full_name' => $user->full_name, 'name' => $user->name]) }}
            </x-slot>

            <x-slot name="content">
                <label for="name-{{ $user->id }}">{{ __('Username') }}</label>
                <input
                    type="text"
                    name="name-{{ $user->id }}"
                    id="name-{{ $user->id }}"
                    wire:model="user.name" />
                @error('user.name')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror

                <label for="full_name-{{ $user->id }}">{{ __('Full Name') }}</label>
                <input type="text"
                       name="full_name-{{ $user->id }}"
                       id="full_name-{{ $user->id }}"
                       wire:model="user.full_name" />
                @error('user.full_name')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror

                <label for="email-{{ $user->id }}">{{ __('Email') }}</label>
                <input type="email"
                       name="email-{{ $user->id }}"
                       id="email-{{ $user->id }}"
                       wire:model="user.email" />
                @error('user.email')
                <span class="text-red-500">
                  {{ $message }}
                </span>
                @enderror

                <div class="md:grid grid-cols-2 gap-2">
                    <div>
                        <label for="password-{{ $user->id }}">{{ __('Password') }}</label>
                        <input type="password"
                               name="password-{{ $user->id }}"
                               id="password-{{ $user->id }}"
                               wire:model="password" />
                        @error('password')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="password-{{ $user->id }}_confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password"
                               name="password-{{ $user->id }}_confirmation"
                               id="password-{{ $user->id }}_confirmation"
                               wire:model="password_confirmation" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-button wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
