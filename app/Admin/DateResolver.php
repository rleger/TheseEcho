<?php

namespace These\Admin;

use Carbon\Carbon;
use Exception;
use These\Admin\Exceptions\UnableToParseDateException;

/**
 * Class DateResolver.
 */
class DateResolver
{
    /**
     * @var array
     */
    protected $spokenDate = [];

    /**
     *
     */
    public function __construct()
    {
        $this->loadSpokenDate();
    }

    /**
     * Spoken date.
     */
    private function loadSpokenDate()
    {
        $this->spokenDate = [
            'yesturday' => Carbon::yesterday()->toDateString(),
            'today'     => Carbon::today()->toDateString(),
            'tomorrow'  => Carbon::tomorrow()->toDateString(),
        ];
    }

    /**
     * Get date.
     *
     * @param $date
     *
     * @return string
     *
     * @throws UnableToParseDateException
     */
    public function get($date)
    {
        // Try to resolve spoken date (ex yesterday, tomorrow)
        if (array_key_exists(strtolower($date), $this->spokenDate)) {
            return $this->spokenDate[strtolower($date)];
        }

        // Try to parse it
        try {
            return Carbon::parse($date)->toDateString();
        } catch (Exception $e) {
            throw new UnableToParseDateException("Cannot parse date [$date].");
        }
    }
}
