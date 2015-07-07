<?php

namespace These\Handlers\Events;

use These\Events\UserHasLoggedIn;

class LogUserHasLoggedIn extends LogEventHandler
{
    /**
     * Handle the event.
     *
     * @param UserHasLoggedIn $event
     */
    public function handle(UserHasLoggedIn $event)
    {
        $this->log->info("User '$event->username' has logged in !");
    }
}
