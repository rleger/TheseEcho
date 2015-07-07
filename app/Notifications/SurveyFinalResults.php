<?php

namespace These\Notifications;

interface SurveyFinalResults
{
    /**
     * Notify members that SurveyFinalResults.
     *
     * @param $title
     * @param $body
     *
     * @return mixed
     */
    public function notify($title, $body);
}
