<?php

namespace These\Pusher\Pusher_dot_com;

use Pusher as PusherDotCom;
use These\Pusher\Pusher as PusherInterface;

/**
 * Act as a layer between generic pusher service and pusher.com in case we ever want to switch service.
 */
class Pusher implements PusherInterface
{
    /**
     * @var PusherDotCom
     */
    protected $pusher;

    /**
     * @param PusherDotCom $pusher
     */
    public function __construct(PusherDotCom $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * Trigger a push.
     *
     * @param      $channels
     * @param      $event
     * @param      $data
     * @param null $socket_id
     * @param bool $debug
     * @param bool $already_encoded
     *
     * @return bool|string
     *
     * @throws \PusherException
     */
    public function trigger($channels, $event, $data, $socket_id = null, $debug = false, $already_encoded = false)
    {
        return $this->pusher->trigger($channels, $event, $data, $socket_id, $debug, $already_encoded);
    }
}
