<div class="inline-block h-full">
    <span
      wire:click="$set('showCreateStudentFormModal', true)"
      alt="{{ __('Create New Student') }}"
      title="{{ __('Create New Student') }}"
      class="cursor-pointer
             py-2 px-2 h-full
             border-fuse-teal-dk border border-b-2 rounded-xl
             text-fuse-teal-dk hover:text-white hover:bg-fuse-green-900
             text-center uppercase inline-block">{{
      __('Create New Student')
      }}</span>
    <form wire:submit.prevent="submit">
        <x-jet-dialog-modal wire:model="showCreateStudentFormModal">
            <x-slot name="title">
              <h2 class="mt-0">
                {{ __('Create New Student') }}
              </h2>
            </x-slot>

            <x-slot name="content">
              <div>
                <label for="full_name">{{ __('Full Name') }}</label>
                <input
                    type="text"
                    name="full_name"
                    id="full_name"
                    placeholder="{{ __('e.g. Jane Doe') }}"
                    wire:model="student.full_name" />
                @error('student.full_name')<span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div>
                <label for="name">{{ __('Username') }}</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="{{ __('e.g. JaneDoe123') }}"
                    wire:model="student.name" />
                @error('student.name')<span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div>
                <label for="password">{{ __('Password') }}</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    wire:model="password" />
                @error('password')<span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div>
                <label for="password_confirmation">{{ __('Confirm password') }}</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    wire:model="password_confirmation" />
              </div>
              <div>
                <label for="email">{{ __('Email') }}</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    wire:model="student.email" />
                @error('student.email')<span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div>
                <label for="birthday">{{ __('Birthday') }}</label>
                <input
                    type="date"
                    name="birthday"
                    id="birthday"
                    wire:model="student.birthday" />
                @error('student.birthday')<span class="text-red-500">{{ $message }}</span>@enderror
              </div>
              <div>
                <input
                    type="checkbox"
                    name="permission"
                    id="permission"
                    wire:model="permission" />
                <label for="permission">{!! __('If this student is younger than thirteen, I attest that I have collected a <a href="">parental permission form</a> for them.') !!}</label>
              </div>
            </x-slot>

            <x-slot name="footer" x-data>
                <x-jet-secondary-button wire:click="$toggle('showCreateStudentFormModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-button class="disabled:bg-slate-400" x-bind:disabled="! $wire.permission" wire:click="submit" wire:loading.attr="disabled">
                    {{ __('Create student') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
