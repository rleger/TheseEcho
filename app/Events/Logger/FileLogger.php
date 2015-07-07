<?php

namespace These\Events\Logger;

use App;
use Illuminate\Config\Repository as Config;

class FileLogger extends BaseLogger
{
    /**
     * @var string
     */
    protected $LogFileName = 'EventLog.log';

    /**
     * Returns the logfile path.
     *
     * @return string
     */
    public function getLogFilePath()
    {
        return storage_path().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.$this->getLogFileName();
    }

    /**
     * Returns the logfile name.
     *
     * @return string
     */
    protected function getLogFileName()
    {
        $config = App::make(Config::class);

        return $config->get('These.admin.log.filename') ?: $this->LogFileName;
    }
}
