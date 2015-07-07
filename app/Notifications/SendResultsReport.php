<?php

namespace These\Notifications;

interface SendResultsReport
{
    /**
     * Notify members that SendResultsReport.
     *
     * @param $title
     * @param $body
     *
     * @return mixed
     */
    public function notify($title = null, $body = null);
}
