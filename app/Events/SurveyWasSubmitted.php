<?php

namespace These\Events;

use Illuminate\Queue\SerializesModels;

class SurveyWasSubmitted extends Event
{
    use SerializesModels;

    public $id;

    /**
     * Create a new event instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}
