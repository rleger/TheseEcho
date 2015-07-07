<?php

namespace These\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use These\Events\UserHasLoggedIn;
use These\Events\UserHasLoggedOut;
use These\Events\SurveyWasSubmitted;
use These\Events\UnsupportedBrowserEvent;
use These\Events\DatabaseTableWasSavedToCSV;
use These\Handlers\Events\LogUserHasLoggedIn;
use These\Handlers\Events\LogUserHasLoggedOut;
use These\Handlers\Events\LogSurveyWasSubmitted;
use These\Handlers\Events\LogUnsupportedBrowser;
use These\Handlers\Events\LogDatabaseTableWasSavedToCSV;
use These\Handlers\Events\PushSurveyWasSubmitted;
use These\Handlers\Events\PushDatabaseTableWasSavedToCSV;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // User events
        UserHasLoggedOut::class => [
            LogUserHasLoggedOut::class,
        ],
        UserHasLoggedIn::class => [
            LogUserHasLoggedIn::class,
        ],

        // Survey Events
        SurveyWasSubmitted::class => [
            LogSurveyWasSubmitted::class,
            PushSurveyWasSubmitted::class,
        ],

        // Unsupported browser events
        UnsupportedBrowserEvent::class => [
            LogUnsupportedBrowser::class,
        ],

        // Database table(s) was saved to csv
        DatabaseTableWasSavedToCSV::class => [
            LogDatabaseTableWasSavedToCSV::class,
            PushDatabaseTableWasSavedToCSV::class,
        ],
    ];

     /**
      * Register any other events for your application.
      *
      * @param  \Illuminate\Contracts\Events\Dispatcher  $events
      */
     public function boot(DispatcherContract $events)
     {
         parent::boot($events);
        //
     }
}
