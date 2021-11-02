<footer class="align-bottom bg-fuse-teal-500 md:grid md:grid-cols-2 px-20 py-10 max-w-screen">
  <div class="md:px-4 lg:px-10">
    <h3 class="text-white font-extrabold text-4xl pb-10 font-display">
      {{ __(':count students', ['count' => '30,000']) }}
    </h3>
    <ul class="leading-loose font-semibold">
      <li><a href="https://www.fusestudio.net/privacy">{{ __('Privacy Policy') }}</a></li>
      <li><a href="https://www.fusestudio.net/terms-of-use">{{ __('Terms of Use') }}</a></li>
      <li><a href="https://www.fusestudio.net/our-story">{{ __('About') }}</a></li>
      <li><a href="mailto:info@fusestudio.net">info@fusestudio</a></li>
    </ul>
  </div>
  <div class="md:px-4 lg:px-10">
    <h3 class="text-white font-extrabold text-4xl pb-10 font-display">
      {{ __(':count schools', ['count' => '200']) }}
    </h3>
    <p>{{ __('Translation') }}</p>
  </div>
</footer>
