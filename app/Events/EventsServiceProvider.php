<?php

namespace These\Events;

use Illuminate\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('These\Events\Logger\EventLogger', 'These\Events\Logger\FileEventLogger');
    }
}
