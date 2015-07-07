<?php

namespace These\Providers;

use Pusher;
use Illuminate\Support\ServiceProvider;

class PusherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->singleton('Pusher', function ($app) {
            $keys = $app['config']->get('services.pusher');

            return new Pusher($keys['key'], $keys['secret'], $keys['app_id']);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
