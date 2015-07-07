<?php

namespace These\Events;

use Illuminate\Queue\SerializesModels;

class UnsupportedBrowserEvent extends Event
{
    use SerializesModels;

    public $browserVersion;

    /**
     * Create a new event instance.
     */
    public function __construct($browserVersion)
    {
        $this->browserVersion = $browserVersion;
    }
}
