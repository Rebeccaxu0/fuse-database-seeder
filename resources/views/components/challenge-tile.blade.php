<div>
  <x-progress-bar :challengeVersion="$challengeVersion" :user="auth()->user()"/>
    <h2>{{ $challengeVersion->name }}</h2>
</div>
