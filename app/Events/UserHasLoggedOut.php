<?php

namespace These\Events;

use Illuminate\Queue\SerializesModels;

class UserHasLoggedOut extends Event
{
    use SerializesModels;

    public $username;

    /**
     * Create a new event instance.
     */
    public function __construct($username)
    {
        $this->username = $username;
    }
}
