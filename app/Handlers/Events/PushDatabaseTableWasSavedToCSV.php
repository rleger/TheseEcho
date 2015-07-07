<?php

namespace These\Handlers\Events;

use These\Events\DatabaseTableWasSavedToCSV;

/**
 * Class SurveyWasSubmitted.
 */
class PushDatabaseTableWasSavedToCSV extends PusherEventHandler
{
    /**
     * Handle event.
     *
     * @param $event
     */
    public function handle(DatabaseTableWasSavedToCSV $event)
    {
        $this->pusher->trigger('theseecho', 'DatabaseTableWasSavedToCSV', $event->tables);
    }
}
