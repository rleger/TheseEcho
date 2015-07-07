<?php

namespace These\Handlers\Events;

use These\Events\DatabaseTableWasSavedToCSV;

/**
 * Class SurveyWasSubmitted.
 */
class LogDatabaseTableWasSavedToCSV extends LogEventHandler
{
    /**
     * Handle event.
     *
     * @param $event
     */
    public function handle(DatabaseTableWasSavedToCSV $event)
    {
        $this->log->info('Database tables ['.implode(',', $event->tables).'] were exported to csv !');
    }
}
