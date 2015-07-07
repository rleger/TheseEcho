<?php

namespace These\Pusher;

/**
 * Interface Pusher.
 */
interface Pusher
{
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
     * @return mixed
     */
    public function trigger($channels, $event, $data, $socket_id = null, $debug = false, $already_encoded = false);
}
