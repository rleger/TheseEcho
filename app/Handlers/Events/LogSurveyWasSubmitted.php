<?php

namespace These\Handlers\Events;

use These\Events\SurveyWasSubmitted;

/**
 * Class SurveyWasSubmitted.
 */
class LogSurveyWasSubmitted extends LogEventHandler
{
    /**
     * Handle event.
     *
     * @param $event
     */
    public function handle(SurveyWasSubmitted $event)
    {
        $this->log->info("A new survey was submitted. Database id='$event->id'.");
    }
}
