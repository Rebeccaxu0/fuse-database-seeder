<?php

namespace App\LTI;

use Illuminate\Support\Facades\Cookie as LaravelCookie;
use Packback\Lti1p3\Interfaces\ICookie;

class Cookie implements ICookie
{
    public function getCookie(string $name): ?string
    {
        return LaravelCookie::get($name, false);
    }

    public function setCookie(string $name, string $value, $exp = 3600, $options = []): void
    {
        // By default, make the cookie expire within a minute
        LaravelCookie::queue($name, $value, $exp / 60);
    }
}
