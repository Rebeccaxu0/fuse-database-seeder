<x-app-layout>

    <div class="pl-8">
        <x-slot name="title">{{ __('My Studio Settings') }}</x-slot>
        <x-slot name="header">{{ __('My Studio Settings') }}</x-slot>


        <h2 class="-ml-8 uppercase text-left">{{ __('Studio Code') }}</h2>

        <livewire:studio-code :studio="$studio" >
        <div class="text-sm border rounded p-2 ml-4">{!!
        __('Reminder: Users under 13 must have signed <a href="https://fusestudio.zendesk.com/hc/en-us/articles/360010468912-Permission-Slips-and-Accounts-for-students-under-13">permission forms</a> before starting FUSE.')
        !!}</div>


        <h2 class="-ml-8 mt-12 uppercase text-left">{{ __('Studio Settings') }}</h2>

        <h3 class="text-fuse-teal-dk">{{ __('Dashboard Message') }}</h3>

        <livewire:studio-dashboard-message :studio="$studio" >

        <h3 class="text-fuse-teal-dk">{{ __('Sign In') }}</h3>

        <livewire:studio-bool-toggle :studio="$studio"
            property="universal_pwd"
            :label="__('Studio Code as Universal Password')" >

        <p class="text-sm border rounded p-2 ml-4">{{
        __('Turning this on will allow any member of your studio to sign in using the above studio code as a password.')
        }}</p>

        <h3 class="text-fuse-teal-dk">{{ __('Registration') }}</h3>

        <div class="mb-4">
          <livewire:studio-bool-toggle :studio="$studio"
              property="require_email"
              :label="__('Collect Student Email')">
        </div>

        <livewire:studio-bool-toggle :studio="$studio"
              property="allow_non_binary_gender_options"
              :label="__('Allow Non-binary Gender Options')">

        <p class="text-sm border rounded p-2 ml-4">
        {{ __('Traditional gender choices: Girl/Boy/Prefer not to say') }}<br>
        {{ __('Non-binary gender choices: Female/Male/Non-binary/Prefer not to say') }}
        </p>

        <h3 class="text-fuse-teal-dk">{{ __('Website Features') }}</h3>

        <div class="mb-4">
          <livewire:studio-bool-toggle :studio="$studio"
              property="allow_comments"
              :label="__('Allow Comments')">
        </div>

        <livewire:studio-bool-toggle :studio="$studio"
              property="allow_ideas"
              :label="__('Allow Ideas')">
    </div>

</x-app-layout>

