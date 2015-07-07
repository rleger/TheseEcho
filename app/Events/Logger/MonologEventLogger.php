<?php

namespace These\Events\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as Logger;

/**
 * Class FileEventLogger.
 */
class MonologEventLogger extends FileLogger implements EventLogger
{
    /**
     * @var Logger
     */
    protected $log;

    /**
     *
     */
    public function __construct()
    {
        // create a log channel
        $this->log = new Logger('Event');
        $this->log->pushHandler(new StreamHandler($this->getLogFilePath()));
    }

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function message($contents)
    {
        return $this->log->addNotice($contents);
    }

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function info($contents)
    {
        return $this->log->addInfo($contents);
    }

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function caution($contents)
    {
        return $this->log->addWarning($contents);
    }

    /**
     * @param $contents
     *
     * @return mixed
     */
    public function warning($contents)
    {
        return $this->log->addCritical($contents);
    }
}
