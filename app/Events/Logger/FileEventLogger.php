<?php

namespace These\Events\Logger;

use Illuminate\Filesystem\Filesystem;

/**
 * Class FileEventLogger.
 */
class FileEventLogger extends FileLogger implements EventLogger
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Constructor.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Log an info.
     *
     * @param $contents
     *
     * @return mixed|void
     */
    public function info($contents)
    {
        return $this->log($contents, 'info');
    }

    /**
     * Generic log function.
     *
     * @param        $contents
     * @param string $level
     */
    protected function log($contents, $level = 'info')
    {
        $contents = $this->buildLogLine($contents, $level);

        return $this->filesystem->prepend($this->getLogFilePath(), $contents);
    }

    /**
     * Build the line that will be logged.
     *
     * @param $contents
     * @param $level
     *
     * @return string
     */
    protected function buildLogLine($contents, $level)
    {
        return date('Y-m-d H:i:s').' ['.strtoupper($level).'] '.$contents."\n";
    }

    /**
     * Log a message.
     *
     * @param $contents
     *
     * @return mixed
     */
    public function message($contents)
    {
        return $this->log($contents, 'message');
    }

    /**
     * Log a caution.
     *
     * @param $contents
     *
     * @return mixed
     */
    public function caution($contents)
    {
        return $this->log($contents, 'caution');
    }

    /**
     * Log a warning.
     *
     * @param $contents
     *
     * @return mixed
     */
    public function warning($contents)
    {
        return $this->log($contents, 'warning');
    }
}
