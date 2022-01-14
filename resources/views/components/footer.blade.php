@props(['youth' => 0, 'schools' => 0])
<footer class="bg-gray-100 container">
    <div>
        <p>FUSE</p>
        <p>level up.</p>
    </div>
    <div>
        <h2>
            {{ __(':count Youth', ['count' => $youth]) }}
        </h2>
    </div>
    <div>
        <h2>
            {{ __(':count schools', ['count' => $schools]) }}
        </h2>
    </div>
    {{ __('Copyright © 2012-:current. All rights reserved.', ['current' => 2021]) }}
</footer>
