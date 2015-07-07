<?php

namespace These\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Events\Dispatcher;
use These\Events\UnsupportedBrowserEvent;

/**
 * Class SupportedBrowser.
 */
class SupportedBrowser implements Middleware
{
    protected $dispatcher;

    /**
     * Constructor.
     *
     * @param Dispatcher $dispatcher event dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $serverAgent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : null;

        // Cannot determine browser version
        if (is_null($serverAgent)) {
            return;
        }

        // Look for IE browser
        preg_match('/MSIE (.*?);/', $serverAgent, $matches);

        if (count($matches) < 2) {
            preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $serverAgent, $matches);
        }

        if (count($matches) > 1) {
            //Then we're using IE
            $version = $matches[1];

            if ($version < 8) {
                $this->dispatcher->fire(new UnsupportedBrowserEvent('IE<8'));

                return view('unsupportedBrowser');
            }
        }

        return $next($request);
    }
}
