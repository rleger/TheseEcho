<?php

namespace These\Handlers\Events;

use These\Pusher\Pusher;

/**
 * Class EventHandler.
 */
abstract class PusherEventHandler
{
    /**
     * @var Pusher
     */
    protected $pusher;

    /**
     * Event Pusher.
     *
     * @param Pusher $pusher
     */
    public function __construct(Pusher $pusher)
    {
        $this->pusher = $pusher;
    }
}
