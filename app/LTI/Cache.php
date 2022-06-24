<?php

namespace App\LTI;

use Illuminate\Support\Facades\Cache as LaraCache;
use Packback\Lti1p3\Interfaces\ICache;

class Cache implements ICache
{
    public const NONCE_PREFIX = 'nonce_';

    public function getLaunchData(string $key): ?array
    {
        return LaraCache::get($key);
    }

    public function cacheLaunchData(string $key, array $jwtBody): void
    {
        $duration = Config::get('cache.duration.default');
        LaraCache::put($key, $jwtBody, $duration);
    }

    public function cacheNonce(string $nonce, string $state): void
    {
        $duration = Config::get('cache.duration.default');
        LaraCache::put(static::NONCE_PREFIX . $nonce, $state, $duration);
    }

    public function checkNonceIsValid(string $nonce, string $state): bool
    {
        return LaraCache::get(static::NONCE_PREFIX . $nonce, false) === $state;
    }

    public function cacheAccessToken(string $key, string $accessToken): void
    {
        $duration = Config::get('cache.duration.min');
        LaraCache::put($key, $accessToken, $duration);
    }

    public function getAccessToken(string $key): ?string
    {
        return LaraCache::has($key) ? LaraCache::get($key) : null;
    }

    public function clearAccessToken(string $key): void
    {
        LaraCache::forget($key);
    }
}

