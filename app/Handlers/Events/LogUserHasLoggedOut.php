<?php

namespace These\Handlers\Events;

use These\Events\UserHasLoggedOut;

class LogUserHasLoggedOut extends LogEventHandler
{
    /**
     * Handle the event.
     *
     * @param UserHasLoggedOut $event
     */
    public function handle(UserHasLoggedOut $event)
    {
        $this->log->info("User '$event->username' has logged out !");
    }
}
