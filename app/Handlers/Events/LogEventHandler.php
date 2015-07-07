<?php

namespace These\Handlers\Events;

use Pusher;
use These\Events\Logger\EventLogger;

/**
 * Class EventHandler.
 */
abstract class LogEventHandler
{
    /**
     * @var EventLogger
     */
    protected $log;

    /**
     * @var Pusher
     */
    protected $pusher;

    /**
     * Event Logger.
     *
     * @param EventLogger $log
     * @param Pusher      $pusher
     */
    public function __construct(EventLogger $log, Pusher $pusher)
    {
        $this->log = $log;

        $this->pusher = $pusher;
    }
}
