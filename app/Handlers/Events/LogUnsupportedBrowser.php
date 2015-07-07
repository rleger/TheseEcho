<?php

namespace These\Handlers\Events;

use These\Events\UnsupportedBrowserEvent;

class LogUnsupportedBrowser extends LogEventHandler
{
    /**
     * Handle the event.
     *
     * @param UserHasLoggedIn $event
     */
    public function handle(UnsupportedBrowserEvent $event)
    {
        $this->log->warning("Browser not suppoted. ['$event->browserVersion']");
    }
}
