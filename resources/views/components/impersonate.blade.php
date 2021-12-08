<div class="absolute top-0">
  You are {{ Auth::user()->name }} (uid:{{ Auth::user()->id }}).
</div>
@canImpersonate
<div class="absolute bottom-0">
  <a href="{{ route('impersonate', 3) }}">Masquerade as user 1</a>
</div>
@endCanImpersonate

@impersonating
<div class="absolute bottom-0">
  <a href="{{ route('impersonate.leave') }}">Stop Masquerade</a>
</div>
@endImpersonating