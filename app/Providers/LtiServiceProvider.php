<?php

namespace App\Providers;

use App\LTI\Cache as LTICache;
use App\LTI\Cookie as LTICookie;
use App\LTI\Database as LTIDatabase;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Packback\Lti1p3\Interfaces\ICache;
use Packback\Lti1p3\Interfaces\ICookie;
use Packback\Lti1p3\Interfaces\IDatabase;
use Packback\Lti1p3\Interfaces\ILtiServiceConnector;

class LtiServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        ICache::class => LTICache::class,
        ICookie::class => LTICookie::class,
        IDatabase::class => LTIDatabase::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // As of Version 3.0
        $this->app->bind(ILtiServiceConnector::class, function ($app) {
            return new ILtiServiceConnector($app->resolveProvider(ICache::class), new Client([
                'timeout' => 30,
            ]));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // LTI related setting
        // See https://github.com/packbackbooks/lti-1-3-php-library/wiki/Laravel-Implementation-Guide
        JWT::$leeway = 5;
    }
}
