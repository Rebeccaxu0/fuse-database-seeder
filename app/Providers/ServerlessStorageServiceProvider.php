<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServerlessStorageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (in_array(config('SERVER_SOFTWARE'), ['bref', 'vapor'])) {
            $path = '/tmp/storage';
            $directories = [
                '/app',
                '/cache',
                '/framework/cache',
                '/framework/views',
                '/bootstrap/cache',
            ];
            foreach ($directories as $directory) {
                if (! is_dir($path . $directory)) {
                    mkdir($path . $directory, 0755, true);
                }
            }
            $this->app->useStoragePath($path);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
