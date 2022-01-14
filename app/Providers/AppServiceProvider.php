<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      if ($this->app->environment('local')) {
        $this->app->register(TelescopeServiceProvider::class);
      }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Relation::morphMap([
        'artifact' => 'App\Models\Artifact',
        'idea' => 'App\Models\Idea',
        'level' => 'App\Models\Level',
      ]);
    }
}
