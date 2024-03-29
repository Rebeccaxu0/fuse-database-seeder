<div class="flex flex-col md:flex-row lg:flex-col xl:flex-row items-center justify-center gap-1">
    @if (JoelButcher\Socialstream\Socialstream::hasFacebookSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::facebook()]) }}">
            <x-facebook-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">Facebook</span>
        </a>
    @endif

    <a class="w-full bg-white border rounded flex p-2 shadow whitespace-nowrap"
        href="{{ route('oauth.redirect', ['provider' => 'clever']) }}">
        <x-clever-icon class="h-6 w-6 mr-2" />
        <span class="text-black">{{ __('Sign in with Clever') }}</span>
        <span class="sr-only">Clever</span>
    </a>

    @if (JoelButcher\Socialstream\Socialstream::hasGoogleSupport())
        <a class="w-full bg-white border rounded flex p-2 shadow whitespace-nowrap"
          href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::google()]) }}" >
            <x-google-icon class="h-6 w-6 mr-2" />
            <span class="text-black">{{ __('Sign in with Google') }}</span>
            <span class="sr-only">Google</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasTwitterSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::twitter()]) }}">
            <x-twitter-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">Twitter</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasLinkedInSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::linkedin()]) }}">
            <x-linked-in-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">LinkedIn</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasGithubSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::github()]) }}">
            <x-github-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">GitHub</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasGitlabSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::gitlab()]) }}">
            <x-gitlab-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">GitLab</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasBitbucketSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::bitbucket()]) }}">
            <x-bitbucket-icon />
            <span class="sr-only">BitBucket</span>
        </a>
    @endif
</div>

<div class="flex flex-row items-center justify-between py-4 text-slate-800">
    <hr class="w-full mr-2 border-fuse-blue">
        {{ __('Or') }}
    <hr class="w-full ml-2 border-fuse-blue">
</div>
