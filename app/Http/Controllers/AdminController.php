<?php

namespace These\Http\Controllers;

use Illuminate\Filesystem\Filesystem;

/**
 * Class ResultsController.
 */
class AdminController extends Controller
{
    /**
     * Constructor.
     *
     * @param ResultsService $resultsService
     *
     * @internal param ResultsRepository $results
     */
    public function __construct()
    {
        // Require authenticated user
        $this->middleware('auth');

        // Check for unsupportedBrowser
        $this->middleware('supportedBrowser');
    }

    /**
     * Display a log file.
     *
     * @param Filesystem $filesystem
     * @param            $filename
     *
     * @return \Illuminate\View\View
     *
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function viewLog(Filesystem $filesystem, $filename)
    {
        $logFilePath = storage_path().'/logs/'.$filename;

        if (!file_exists($logFilePath)) {
            throw new \Exception("Cannot find [$logFilePath]");
        }

        $log = $filesystem->get($logFilePath);

        return view('results.log', compact('log'));
    }
}
