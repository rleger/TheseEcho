<?php

namespace These\Events\Logger;

/**
 * Interface EventLogger.
 */
interface EventLogger
{
    /**
     * @param $contents
     *
     * @return mixed
     */
    public function message($contents);

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function info($contents);

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function caution($contents);

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function warning($contents);
}
