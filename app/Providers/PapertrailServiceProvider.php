<?php

namespace These\Providers;

use Log;
use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SyslogHandler;

class PapertrailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $monolog = Log::getMonolog();
        $syslog = new SyslogHandler('papertrail');
        $formatter = new LineFormatter('%channel%.%level_name%: %message% %extra%');
        $syslog->setFormatter($formatter);

        $monolog->pushHandler($syslog);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
