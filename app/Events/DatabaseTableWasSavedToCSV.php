<?php

namespace These\Events;

use Illuminate\Queue\SerializesModels;

class DatabaseTableWasSavedToCSV extends Event
{
    use SerializesModels;

    public $tables;

    /**
     * Create a new event instance.
     */
    public function __construct($tables)
    {
        $this->tables = $tables;
    }
}
