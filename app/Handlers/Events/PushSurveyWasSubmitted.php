<?php

namespace These\Handlers\Events;

use These\Events\SurveyWasSubmitted;

/**
 * Class SurveyWasSubmitted.
 */
class PushSurveyWasSubmitted extends PusherEventHandler
{
    /**
     * Handle event.
     *
     * @param $event
     */
    public function handle(SurveyWasSubmitted $event)
    {
        $this->pusher->trigger('theseecho', 'SurveyWasSubmitted', []);
    }
}
